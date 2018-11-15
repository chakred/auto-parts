<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    public function autoMark()
    {
        return $this->belongsTo('App\Auto_mark', 'id_mark' , 'id_mark');
    }

    public function autoModels()
    {
        return $this->belongsTo('App\Auto_model', 'id_model' , 'id_model');
    }

}
