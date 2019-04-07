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

    public function goods()
    {
        return $this->hasMany('App\Good', 'id_sub_category' , 'id');
    }
}
