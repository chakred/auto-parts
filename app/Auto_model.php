<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto_model extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_model';

    public function autoMark()
    {
        return $this->belongsTo('App\Auto_mark', 'id_mark' , 'id_mark');
    }
}
