<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsumosSafra extends Model
{
    public function safra(){
        return $this->belongsTo(Safra::class);
    }

    public function insumo(){
        return $this->belongsTo(Insumo::class);
    }

    public function incidente(){
        return $this->belongsTo(Incidente::class);
    }
}
