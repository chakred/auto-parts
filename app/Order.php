<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function goods()
    {
        return $this->belongsTo('App\Good', 'goods_id' , 'id');
    }
}
