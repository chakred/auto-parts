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
        $allNewOrders = self::where('status', 'new')
            ->whereNull('deleted_at')
            ->get();

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

    /**
     * This query collects records according to key word
     *
     * @param $query
     * @param $keyWord
     * @return mixed
     */
    public function scopeKeyWord($query, $keyWord)
    {
        return $query->where(function($q) use ($keyWord) {
            $q->where('buyer_name', 'like', '%'.$keyWord.'%');
            $q->orWhere('buyer_phone', 'like', '%'.$keyWord.'%');
            $q->orWhere('id', 'like', '%'.$keyWord.'%');
            $q->orWhereHas('goods', function($subquery) use ($keyWord) {
                $subquery->where('name_good', 'like', '%'.$keyWord.'%');
                $subquery->orWhere('desc_good', 'like', '%'.$keyWord.'%');
            });
        });
    }
}
