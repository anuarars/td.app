<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'order_id', 'worker_id', 'name', 'description', 'measure', 'count'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function user(){
        return $this->belongsToMany(User::class)->withPivot('price')->withTimestamps();
    }

    // public function workers(){
    //     return $this->belongsToMany(User::class)->withPivot('price')->withTimestamps();
    // }

}
