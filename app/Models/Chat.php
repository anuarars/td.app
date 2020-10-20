<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    protected $fillable = ['message', 'order_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->BelongsTo(Order::class);
    }
}
