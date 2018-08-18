<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InsumoTipo;

class InsumoTipoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insumoTipo = InsumoTipo::all();

        return response()->json($insumoTipo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(InsumoTipo $insumoTipo)
    {
        return response()->json($insumoTipo);
    }

    
}
