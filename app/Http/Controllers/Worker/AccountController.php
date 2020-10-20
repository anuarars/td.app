<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(){
        return view('account.index');
    }

    public function orders(){
        $orders = Order::whereIn('category_id', Auth::user()->categories->pluck('id'))->where('review_end', '>', now())->orderBy('review_end', 'asc')->paginate(12);
        return view('order.subscribed', compact('orders'));
    }

    public function offers(){
        $orders = Auth::user()->orders();
        return view('account.offer', compact('orders'));
    }

    public function chat(){
        $orders = Auth::user()->orders;
        
        return view('chat.index', compact('orders'));
    }
    
}