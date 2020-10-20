<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 'region_id', 'district', 'town', 'home', 'street', 'unit', 'postcode'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function region(){
        return $this->hasMany(Region::class);
    }
}
