<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FurtherSubCategory extends Model
{
    public $timestamps = false;
    protected $table = 'further_sub_categories';

    public function subCategory()
    {
        return $this->belongsTo(Sub_category::class, 'id_sub_category' , 'id');
    }

    public function goods()
    {
        return $this->hasMany(Good::class, 'id_further_sub_category' , 'id');
    }
}
