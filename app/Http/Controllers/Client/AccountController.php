<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\Protocol;

class AccountController extends Controller
{
    public function index(){
        return view('account.index');
    }

    public function chat(){
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->whereBetween('order_discuss', [now()->subWeek(), now()->addWeek()])->orderBy('order_discuss', 'desc')->get();
        return view('chat.index', compact('orders'));
    }

    public function protocolStore(Request $request, $id){
        foreach($request->product as $i => $product_id){
            $product = Product::find($product_id);
            $price = $product->user()->where('user_id', $request->users[$i])->first()->pivot->price;
            Protocol::create([
                'product_id' => $product_id,
                'order_id' => $id,
                'worker_id' => $request->users[$i],
                'price' => $price,
                'execution_date' => $request->execution_date[$i]
            ]);
        }

        return redirect()->route('protocol.show', $id);
    }
}