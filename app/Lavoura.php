<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Safra;

class Lavoura extends Model
{

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function safras(){
        return $this->hasMany(Safra::class);
    }
}
