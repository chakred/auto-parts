<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto_mark extends Model
{
    public $timestamps = false;

    public function autoModels()
    {
        return $this->hasOne('App\Auto_model', 'id' , 'id');
    }
}
