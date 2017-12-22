<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    public function posts()
    {
        return $this->hasMany('App\Post', 'buyer_id', 'id');
    }
}
