<?php

namespace App\Http\Controllers;

use App\Unidade;

class UnidadeController extends Controller
{

    public function index(){
        $unidades = Unidade::all();
        return response()->json($unidades);
    }

    public function show(Unidade $unidade)
    {
        return response()->json($unidade);
    }
}
