<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto_mark extends Model
{
    public $timestamps = false;

    public function autoModels()
    {
        return $this->hasMany('App\Auto_model', 'auto_mark_id' , 'id');
    }
}
