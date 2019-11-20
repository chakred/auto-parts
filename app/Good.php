<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = [
        'id_inner',
        'name_good',
        'desc_good',
        'img_path',
        'mark_good',
        'country',
        'cost',
        'profit',
        'discount',
        'currency',
        'quantity',
        'item',
        'id_model',
        'id_sub_category',
        'id_further-sub-category',
        'slug'
    ];

    public function autoMark()
    {
        return $this->belongsTo('App\Auto_mark', 'auto_mark_id' , 'id');
    }

    public function autoModels()
    {
        return $this->belongsTo('App\Auto_model', 'id_model' , 'id');
    }

    public function subCategories()
    {
        return $this->belongsTo('App\Sub_category', 'id_sub_category' , 'id');
    }

    public function furtherSubCategories()
    {
        return $this->belongsTo('App\FurtherSubCategory', 'id_further_sub_category' , 'id');
    }

}
