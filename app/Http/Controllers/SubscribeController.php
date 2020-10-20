<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    public function index(){
        $user = Auth::user();
        $subscribes = Subscribe::all();
        return view('subscribe', compact('subscribes', 'user'));
    }

    public function store($subscribe_id){
        $subscribe = Subscribe::find($subscribe_id);
        $user = User::find(Auth::id());

        if($user->balance < $subscribe->price){
            return back()->with(['error' => 'У вас недостаточно баланса']);
        }else{
            if($user->PaySubscribe()){
                $user->subscribes()->detach('1');

                $user->update([
                    'balance' => $user->balance - $subscribe->price
                ]);
    
                $user->subscribes()->attach($subscribe->id, [
                    'expire_at' => now()->add($subscribe->integer, $subscribe->measure)
                ]);

                return back();
                
            }else{
                if($subscribe_id == 1){
                    $user->subscribes()->attach($subscribe->id, [
                        'expire_at' => now()->add($subscribe->integer, $subscribe->measure)
                    ]);
    
                    return back();
                }else{
                    $user->update([
                        'balance' => $user->balance - $subscribe->price
                    ]);
        
                    $user->subscribes()->attach($subscribe->id, [
                        'expire_at' => now()->add($subscribe->integer, $subscribe->measure)
                    ]);
    
                    return back();
                }
            }
        }
    }
}