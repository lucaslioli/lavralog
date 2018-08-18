<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    protected $guarded = [];

    public function safra(){
        return $this->belongsTo(Safra::class);
    }
}
