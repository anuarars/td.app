<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Mail\ClientRequestMail;
use App\Mail\OrderRequestMail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function show($id){
        $order = Order::find($id);
        $user = Auth::user();
        if($order->workers->contains($user->id)){
            return view('order.show',[
                'order' => $order
            ]);
        }else{
            return view('order.show', compact('order'));
        }
    }

    public function request(Request $request, $id){
        $order = Order::find($id);
        $user = Auth::user();
        $pay_subscription = Subscribe::find(1);
        if($user->hasSubscribe()){
            if($user->PaySubscribe()){
                $update_balance = $user->balance - $pay_subscription->price;
                if($update_balance < 0){
                    return 'nobalance';
                }else{
                    $request->validate([
                        'price' => 'required',
                    ],[
                        'price.required' => 'Укажите стартовую сумму'
                    ]);
                    
                    $user->update([
                        'balance' => $update_balance,
                    ]);
                    $order->workers()->attach(Auth::id(),[
                        'accepted' => '1'
                    ]);

                    $price = $request->price;
                    foreach($request->ids as $i => $product_id){
                        if($user->products->contains($product_id)){
                            $pivot_row = $user->products()->where('product_id', $product_id)->first()->pivot;
                            $pivot_row->price = $price[$i];
                            $pivot_row->update();
                        }else{
                            $user->products()->attach($product_id,[
                                'price' => $price[$i]
                            ]);
                        }
                    }

                    Mail::to(Auth::user()->email)->send(new OrderRequestMail);
                    Mail::to($order->user->email)->send(new ClientRequestMail);
                    return 'succesfull';
                }
            }else{
                $request->validate([
                    'price' => 'required',
                ],[
                    'price.required' => 'Укажите стартовую сумму'
                ]);

                $order->workers()->attach(Auth::id(),[
                    'accepted' => '1'
                ]);

                $price = $request->price;
                foreach($request->ids as $i => $product_id){
                    if($user->products->contains($product_id)){
                        $pivot_row = $user->products()->where('product_id', $product_id)->first()->pivot;
                        $pivot_row->price = $price[$i];
                        $pivot_row->update();
                    }else{
                        $user->products()->attach($product_id,[
                            'price' => $price[$i]
                        ]);
                    }
                }

                Mail::to(Auth::user()->email)->send(new OrderRequestMail);
                Mail::to($order->user->email)->send(new ClientRequestMail);
                return 'succesfull';
            }
            
        }else{
            return 'nosub';
        }
    }

    public function productUpdate(Request $request){
        $user = Auth::user();

        $price = $request->price;
        foreach($request->ids as $i => $product_id){
            if($user->products->contains($product_id)){
                $pivot_row = $user->products()->where('product_id', $product_id)->first()->pivot;
                $pivot_row->price = $price[$i];
                $pivot_row->update();
            }else{
                $user->products()->attach($product_id,[
                    'price' => $price[$i]
                ]);
            }
        }

        return back();        
    }
}