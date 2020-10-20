<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;

class AddressController extends Controller
{
    public function index(){
        if(Auth::user()->address !== null){
            return redirect()->home();
        }

        $regions = Region::all();
        return view('auth.address', compact('regions'));
    }

    public function store(Request $request, $id){

        Auth::user()->update([
            'description' => $request->input('description'),
        ]);

        Address::create([
            'user_id' => Auth::id(),
            'region_id' => $request->region_id,
            'district' => $request->district,
            'town' => $request->town,
            'postcode' => $request->postcode,
            'home' => $request->home,
            'street' => $request->street,
            'unit' => $request->unit
        ]);

        return redirect()->home();
    }
}
