<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    public function insumo_tipo(){
        return $this->belongsTo(InsumoTipo::class);
    }
}
