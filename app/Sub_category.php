<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{
    public $timestamps = false;
    protected $table = 'sub_categories';

    public function category()
    {
        return $this->belongsTo('App\Category', 'id_category' , 'id');
    }
}
