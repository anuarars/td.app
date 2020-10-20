<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'bin', 'phone', 'address', 'balance', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function address(){
        return $this->hasOne(Address::class);
    }


    // Заявки созданные клиентом
    public function order(){
        return $this->hasMany(Order::class);
    }

    // Заявки в котором принимает участие исполнитель
    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('accepted')->withTimestamps();
    }

    
    public function hasAnyRoles($roles){
        if($this->roles()->whereIn('name', $roles)->first()){
            return true;
        }
        return false;
    }

    public function hasRole($role){
        if($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function subscribes(){
        return $this->belongsToMany(Subscribe::class)->withPivot('expire_at')->withTimestamps();
    }


    // Проверка имеет ли польователь посделочную подписку
    public function PaySubscribe(){
        foreach ($this->subscribes as $subscribe) {
            if($subscribe->id == '1'){
                return true;
            }
        }
    }

    //Проверка просрочилась ли подписка
    public function hasSubscribe(){
        if($this->subscribes->count() > 0){
            $subscription = $this->subscribes()->orderBy('expire_at', 'desc')->first();
            if($subscription->pivot->expire_at > now() || $this->PaySubscribe()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function subscribe(){
        return $this->subscribes()->orderBy('expire_at', 'desc')->first();
    }

    public function messages(){
        return $this->hasMany(Chat::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('price')->withTimestamps();
    }

    public function protocols(){
        return $this->hasMany(Protocol::class);
    }

    public function offers(){
        return $this->hasMany(Offer::class);
    }
}