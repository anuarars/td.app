<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use App\Models\Subscribe;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:50', 'min:3'],
            'email' => ['required', 'string', 'email', 'min:5', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'bin' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string', 'min:10'],
            'role' => ['required']
        ],
        [
            'name.min'=> 'Название дожно содержать не менее 3 символов',
            'name.required' => 'Название не должно быть пустым',
            'name.max'=> 'Название должно содержать не более 50 символов',
            'email.required'=> 'Email не должен быть пустым',
            'email.email'=> 'Некорректное написание Email',
            'email.unique'=> 'Организация с данным Email уже зарегистрирована',
            'email.min' => 'Email должен содержать не менее 5 символов',
            'email.max' => 'Email должен содержать не более 50 символов',
            'password.required' => 'Пароль не должен быть пустым',
            'password.min' => 'Пароль не должен быть менее 8 символов',
            'password.confirm' => 'Пароли не совпадают',
            'phone.required' => 'Телефон не должен быть пустым',
            'role.required' => 'Пожалуйста выберите роль'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'bin' => $data['bin'],
            'phone' => $data['phone'],
        ]);

        $role = Role::select('id')->where('name', $data['role'])->first();
        $user->roles()->attach($role);
        
        return $user;
    }
}
