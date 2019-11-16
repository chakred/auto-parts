<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto_mark extends Model
{
    protected $fillable = ['name_mark', 'img_path', 'slug'];

    public $timestamps = false;

    public function autoModels()
    {
        return $this->hasMany('App\Auto_model', 'auto_mark_id' , 'id');
    }
}
