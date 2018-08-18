<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Safra;

class Insumo extends Model
{
	protected $guarded = [];
	
    public function insumo_tipo(){
        return $this->belongsTo(InsumoTipo::class);
    }

    public function safras(){
        return $this->belongsToMany(Safra::class, 'insumos_safras');
    }
}
