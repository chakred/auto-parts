<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $table = 'categories';

    public function subCategory()
    {
        return $this->hasOne('App\Category', 'id_category' , 'id');
    }

}
