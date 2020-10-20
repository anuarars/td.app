<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = [
        'name', 'description', 'integer', 'measure', 'price'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
