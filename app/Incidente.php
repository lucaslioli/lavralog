<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidente extends Model
{
    public function safra(){
        return $this->belongsTo(Safra::class);
    }
}
