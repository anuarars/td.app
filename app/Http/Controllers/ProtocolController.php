<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Protocol;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Events\ChatEvent;
use PDF;

class ProtocolController extends Controller
{
    public function index($id){
        $order = Order::find($id);

        $product_for_title = Product::where('order_id', $id)->first();
        $users = ['Единицы'];
        foreach($product_for_title->user as $user){
            $users[] = $user->name;
        }

        $names = [];
        $products = Product::where('order_id', $id)->with('user')->get();
        foreach($products as $k => $product){
            $names[$k] = array_merge(
                $product->only('name'),
                $product->user->pluck('pivot.price')->toArray()
            );
        }

        return view('protocol.index', compact('users', 'names', 'order'));
    }

    public function store(Request $request){
        $user = User::find($request->worker_id);
        $product_ids = explode(',', $request->product_id);
        $product_price = explode(',', $request->product_price);

        Order::where('id', $request->order_id)->update([
            'status' => '1'
        ]);
        
        foreach($product_ids as $i => $product_id){
            if($user->products->contains($product_id)){
                $pivot_row = $user->products()->where('product_id', $product_id)->first()->pivot;
                $pivot_row->price = $product_price[$i];
                $pivot_row->update();
            }else{
                $user->products()->attach($product_id,[
                    'price' => $product_price[$i]
                ]);
            }
        }

        $message = Auth::user()->messages()->create([
            'message' => $user->name.' изменил цену',
            'order_id' => $request->order_id
        ]);

        event(new ChatEvent($message->load('user'), $request->order));
        // event(new ChatEvent($message, $user, $request->order_id));

        return $request->all();
    }

    public function extract(Request $request){
        $product = Product::find($request->product_id);
        $prices = [];
        foreach($product->user as $product){
            $prices[] = $product->pivot->price;
        }
        return $prices;
    }

    public function download($id){
        $order = Order::find($id);

        $product_for_title = Product::where('order_id', $id)->first();
        $users = ['Единицы'];
        foreach($product_for_title->user as $user){
            $users[] = $user->name;
        }

        $names = [];
        $products = Product::where('order_id', $id)->with('user')->get();
        foreach($products as $k => $product){
            $names[$k] = array_merge(
                $product->only('name'),
                $product->user->pluck('pivot.price')->toArray()
            );
        }

        $pdf = PDF::loadView('protocol.download', compact('order', 'users', 'names'));
        return $pdf->download('Protocol.'.uniqid().'.pdf');
    }
}
