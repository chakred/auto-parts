<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
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

}
