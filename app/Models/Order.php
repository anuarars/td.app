<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'name', 'review_start', 'review_end', 'order_discuss'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function workers(){
        return $this->belongsToMany(User::class)->withPivot('accepted')->withTimestamps();
    }

    public function accepted_workers(){
        return $this->belongsToMany(User::class)->wherePivot('accepted', 1);
    }

    public function chats(){
        return $this->hasMany(Chat::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function catalogs(){
        return $this->hasMany(Catalog::class);
    }

    public function protocols(){
        return $this->hasMany(Protocol::class);
    }
}
