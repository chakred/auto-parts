<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'goods_id',
        'quantity',
        'bought_price',
        'buyer_name',
        'buyer_phone',
        'rate',
        'currency_name',
        'status'
    ];

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

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }
}
