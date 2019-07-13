<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{
    public $timestamps = false;
    protected $table = 'sub_categories';

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category' , 'id');
    }

    public function goods()
    {
        return $this->hasMany(Good::class, 'id_sub_category' , 'id');
    }

    public function furtherSubCategory()
    {
        return $this->hasMany(FurtherSubCategory::class, 'id_sub_category' , 'id');
    }
}
