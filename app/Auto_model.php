<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto_model extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function autoMark()
    {
        return $this->belongsTo(Auto_mark::class);
    }
}
