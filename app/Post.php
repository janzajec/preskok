<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'junior_practical';

    public function buyer()
    {
        return $this->hasOne('App\Buyer', 'id', 'buyer_id');
    }

}
