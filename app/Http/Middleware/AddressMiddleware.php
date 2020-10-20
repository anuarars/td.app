<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AddressMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->address == null){
            return redirect()->route('address.index')->with(['error' => 'Пожалуйста заполните данные вашей организации']);
        }else{
            return $next($request);
        }
    }
}
