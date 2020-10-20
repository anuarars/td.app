<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Chat;
use App\Events\ChatEvent;
use App\Models\User;
use App\Models\Product;

class ChatController extends Controller
{
    public function show($order_id){
        $order = Order::where('id', $order_id)->whereBetween('order_discuss', [now()->subWeek(), now()->addWeek()])->first();
        $user = $order->workers()->where('user_id', Auth::id())->first();
        
        if ($order == null) {
            return back();
        }else{
            if($order->workers->contains(Auth::id())){
                if($user->pivot->accepted == '1'){
                    return view('chat.show', compact('order'));
                }else{
                    return back();
                }
            }else if($order->user_id == Auth::id()){
                return view('chat.show', compact('order'));
            }
            else{
                return back();
            }
        }
    }

    public function send(Request $request){
        $message = Auth::user()->messages()->create([
            'message' => $request->message,
            'order_id' => $request->order 
        ]);
        event(new ChatEvent($message->load('user'), $request->order));
        return $message->load('user');
    }

    public function old(Request $request){
         $messages =  Chat::where('order_id', $request->order)->orderBy('id', 'asc')->get();
        return $messages->load('user');
    }


    // Table header call vue js
    public function order_users($order_id){

        $order = Order::find($order_id);
        $users = ['Единицы'];

        foreach($order->workers as $user){
            if($user->pivot->accepted == '1'){
                $users[] = $user->name;
            }
        }
        return $users;
    }

    //Table body call vue js
    public function order_bid($order_id){
        
        $names = [];
        $userId = [];
        $order = Order::find($order_id);
        $users = $order->workers()->wherePivot('accepted', '=', '1')->get();
        
        foreach($users as $user){
            $userId[] = $user->id;
        }
        
        foreach($users as $user){
            foreach($user->products as $k => $product){
                $names[$k] = array_merge(
                    $product->only('name'),
                    $product->user->only($userId)->pluck('pivot.price')->toArray()
                );
            }
        }
        return $names;
    }
}