<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Insumo;

class Safra extends Model
{
    protected $guarded = [];

    public function unidade(){
        return $this->belongsTo(Unidade::class);
    }

    public function lavoura(){
        return $this->belongsTo(Lavoura::class);
    }

    public function insumos(){
        return $this->belongsToMany(Insumo::class, 'insumos_safras');
    }
}
