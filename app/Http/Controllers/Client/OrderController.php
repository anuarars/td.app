<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Http\Requests\OrderRequest;
use App\Mail\OrderCreateMail;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Protocol;
use App\Models\Subscribe;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(){
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->paginate(20);
        return view('order.index', compact('orders'));
    }

    public function create(){
        return view('order.create', [
            'category' => [],
            'categories' => Category::with('children')->where('parent_id', '0')->get(),
            'delimiter' => ''
        ]);
    }

    public function store(OrderRequest $request){
        $user = Auth::user();
        $pay_subscription = Subscribe::find(1);
        if($user->hasSubscribe()){
            if($user->PaySubscribe()){
                $update_balance = $user->balance - $pay_subscription->price;
                if($update_balance < 0){
                    return back()->with(['error' => 'К сожалению, у вас недостаточно баланса']);
                }else{
                    $user->update([
                        'balance' => $update_balance,
                    ]);

                    $order = new Order([
                        'user_id' => Auth::id(),
                        'name' => $request->input('name'),
                        'category_id' => $request->input('category_id'),
                        'review_start' => Carbon::now(),
                        'review_end' => $request->input('review_end'),
                        'order_discuss' => $request->input('order_discuss'),
                    ]);
            
                    $order->save();
            
                    if($request->hasFile('catalog')) {
                        foreach ($request->catalog as $catalog_file) {
                            $catalog_originalName = $catalog_file->getClientOriginalName();
                            $catalog_filename = uniqid().'_'.$catalog_originalName;
                            $catalog_filepath = "/storage/catalogs/$catalog_filename";
                            $catalog_file->storeAs('catalogs', $catalog_filename, 'public');
            
                            $catalog = new Catalog([
                                'file' => $catalog_filepath,
                                'order_id' => $order->id,
                                'user_id' => Auth::id()
                            ]);
                            
                            $catalog->save();
                        }
                    }

                    $product_names = $request->product_name;
                    $product_measures = $request->product_measure;
                    foreach($request->product_description as $i => $description)
                    {
                        if($description !== null){
                            $product = new Product;
                            $product->description = $description;
                            $product->name = $product_names[$i];
                            $product->measure = $product_measures[$i];
                            $product->count = $request->product_count[$i];
                            $product->user_id = Auth::id();
                            $product->order_id = $order->id;

                            $product->save();
                        }
                    }

                    Mail::to(Auth::user()->email)->send(new OrderCreateMail);
            

                    return back()->with(['success' => 'Заявка успешно создана']);
                }
            }else{               
                $order = new Order([
                    'user_id' => Auth::id(),
                    'name' => $request->input('name'),
                    'category_id' => $request->input('category_id'),
                    'review_start' => Carbon::now(),
                    'review_end' => $request->input('review_end'),
                    'order_discuss' => $request->input('order_discuss'),
                ]);
        
                $order->save();
        
                if($request->hasFile('catalog')) {
                    foreach ($request->catalog as $catalog_file) {
                        $catalog_originalName = $catalog_file->getClientOriginalName();
                        $catalog_filename = uniqid().'_'.$catalog_originalName;
                        $catalog_filepath = "/storage/catalogs/$catalog_filename";
                        $catalog_file->storeAs('catalogs', $catalog_filename, 'public');
        
                        $catalog = new Catalog([
                            'file' => $catalog_filepath,
                            'order_id' => $order->id,
                            'user_id' => Auth::id()
                        ]);
                        
                        $catalog->save();
                    }
                }

                $product_names = $request->product_name;
                $product_measures = $request->product_measure;
                foreach($request->product_description as $i => $description)
                {
                    if($description !== null){
                        $product = new Product;
                        $product->description = $description;
                        $product->name = $product_names[$i];
                        $product->measure = $product_measures[$i];
                        $product->count = $request->product_count[$i];
                        $product->user_id = Auth::id();
                        $product->order_id = $order->id;

                        $product->save();
                    }
                }

                Mail::to(Auth::user()->email)->send(new OrderCreateMail);
        
                return back()->with(['success' => 'Заявка успешно создана']);
            }

        }else{
            return back()->with(['error' => 'К сожалению у вас нет подписки для подачи заявки']);
        }
    }

    public function requests(){
        // $orders = Order::where('user_id', Auth::id())->where('review_start', '>', now())->get();
        $orders = Order::where('user_id', Auth::id())->get();
        return view('order.requests', compact('orders'));
    }

    public function destroyRequest($worker_id, $order_id){
        $order = Order::find($order_id);
        $order->workers()->where('user_id', $worker_id)->update([
            'accepted' => '0'
        ]);
        return back()->with(['success'=>'Заявка отклонена']);
    }

    public function acceptRequest($worker_id, $order_id){
        $order = Order::find($order_id);
        $order->workers()->where('user_id', $worker_id)->update([
            'accepted' => '1'
        ]);
        return back()->with(['success'=>'Заявка одобрена']);
    }

    public function show($id){
        $order = Order::find($id);
        $workers = $order->workers()->where('order_id', $id)->get();
        $offers = Offer::where('order_id', $id)->get();
        return view('order.info', compact('workers', 'order', 'offers'));
    }
}