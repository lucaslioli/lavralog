<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lavoura extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}
