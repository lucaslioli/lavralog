<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Safra extends Model
{
    protected $guarded = [];

    public function unidade(){
        return $this->belongsTo(Unidade::class);
    }

    public function lavoura(){
        return $this->belongsTo(Lavoura::class);
    }
}
