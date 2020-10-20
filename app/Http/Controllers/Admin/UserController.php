<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use App\HTTP\Requests\UserRequest;
use App\Models\Region;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $regions = Region::all();
        return view('admin.user.edit', compact('user', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->input('name'),
            'bin' => $request->input('bin'),
            'phone' => $request->input('phone'),
            'balance' => $request->input('balance'),
            'email' => $request->input('email'),
        ]);

        Address::where('user_id', $user->id)->update([
            'region_id' => $request->input('region_id'),
            'home' => $request->input('home'),
            'street' => $request->input('street'),
            'postcode' => $request->input('postcode'),
            'unit' => $request->input('unit'),
        ]);

        return redirect()
            ->route('admin.user.index')
            ->with(['success'=>'Данные организации успешно изменены']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.user.index')->with(['success'=>'организация успешно удалена']);
    }
}
