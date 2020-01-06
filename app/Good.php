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

    /**
     * This query collects records according to key word
     *
     * @param $query
     * @param $keyWord
     * @return mixed
     */
    public function scopeKeyWord($query, $keyWord)
    {
        return $query->where(function($q) use ($keyWord){
            $q->where('name_good', 'like', '%'.$keyWord.'%');
            $q->orWhere('desc_good', 'like', '%'.$keyWord.'%');
            $q->orWhere('mark_good', 'like', '%'.$keyWord.'%');
            $q->orWhere('id_inner', 'like', '%'.$keyWord.'%');
        });
    }

}
