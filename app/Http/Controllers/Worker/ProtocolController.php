<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Protocol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class ProtocolController extends Controller
{
    public function index($order_id, $worker_id){
        $products = Auth::user()->products()->where('order_id', $order_id)->get();
        return view('account.protocol.index', compact('products', 'order_id'));
    }

    public function download($order_id, $worker_id){
        $products = Auth::user()->products()->where('order_id', $order_id)->get();

        $pdf = PDF::loadView('account.protocol.download', compact('products', 'order_id'));
        return $pdf->download('Protocol.'.uniqid().'.pdf');
    }

    public function upload(Request $request, $order_id){
        $offer = $request->file('offer');
        $offer_originalName = $offer->getClientOriginalName();
        $offer_filename = uniqid().'_'.$offer_originalName;
        $offer_filepath = "/storage/offers/$offer_filename";
        $offer->storeAs('offers', $offer_filename, 'public');

        Offer::create([
            'order_id' => $order_id,
            'user_id' => Auth::id(),
            'file' => $offer_filepath,
        ]);

        return back()->with(['success' => 'Коммерческое предложение отправлено']);
    }

    public function list(){
        $protocols = Protocol::where('worker_id', Auth::id())->get();
        return view('account.protocol.list', compact('protocols'));
    }
}
