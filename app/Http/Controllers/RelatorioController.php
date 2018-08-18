<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Lavoura;

class RelatorioController extends Controller
{
    public function lavoura($lavoura){
        
        $safras = DB::table('lavouras')
            ->join('safras', 'lavouras.id', '=', 'safras.lavoura_id')
            ->select('safras.id', 'safras.ano', 'receita_total')
            ->where('lavouras.id', $lavoura)
            ->orderBy('safras.ano')
            ->get();

        $custos = DB::table('lavouras')
            ->join('safras', 'lavouras.id', '=', 'safras.lavoura_id')
            ->join('insumos_safras', 'safras.id', '=', 'insumos_safras.safra_id')
            ->select('safras.id', 'safras.ano', DB::raw('SUM(custo_total) as custo_total'))
            ->where('lavouras.id', $lavoura)
            ->groupBy('safras.id')
            ->orderBy('safras.ano')
            ->get();

        return response()->json([
            'receita_total' => $safras,
            'custo_total' => $custos
        ]);
    }

    public function insumosPorSafra($safra){
        $a = DB::select(DB::raw('SELECT s.cultura, it.descricao as tipo, sum(ins.custo_total) as custo
            FROM safras as s
            join insumos_safras as ins on s.id = ins.safra_id
            join insumos as i on ins.insumo_id = i.id
            join insumo_tipos it on i.insumos_tipo_id = it.id
            where s.id = ' . $safra . '
            group by 2'));
        return response()->json($a);
    }
}
