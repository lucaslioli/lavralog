<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsumoTipo extends Model
{
    public function unidade(){
        return $this->belongsTo(Unidade::class);
    }

}
