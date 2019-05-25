<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function goods()
    {
        return $this->belongsTo('App\Good', 'goods_id' , 'id');
    }

    public static function checkForNewOrders()
    {
        $newOrder = new Order();
        $allNewOrders = $newOrder->where('status', 'new')->get();

        if (count($allNewOrders) > 0) {
            return true;
        } else {
            return false;
        }

    }
}
