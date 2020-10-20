<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'parent_id'];

    public function children(){
        return $this->hasMany(static::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
