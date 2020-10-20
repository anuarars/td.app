<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class ProfileController extends Controller
{
    public function showProfile($id){
        $company = User::find($id);

        if(!$company){
            abort(404);
        }
        
        return view('profile.show', compact('company'));
    }

    public function edit($id){
        if(Auth::id()!=$id){
            return redirect()->home();
        }else{
            $regions = Region::all();
            $company = User::find($id);
            if(!$company){
                abort(404);
            }

            return view('profile.edit', compact('company', 'regions'));
        }
    }

    public function update(Request $request){
        Auth::user()->update([
            'name' => $request->input('name'),
            'bin' => $request->input('bin'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
        ]);

        Address::where('user_id', Auth::id())->update([
            'region_id' => $request->input('region_id'),
            'home' => $request->input('home'),
            'street' => $request->input('street'),
            'postcode' => $request->input('postcode'),
            'unit' => $request->input('unit'),
        ]);

        return back()->with(['success'=>'Данные организации успешно изменены']);
    }
}