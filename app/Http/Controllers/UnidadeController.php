<?php

namespace App\Http\Controllers;

use App\Unidade;

class UnidadeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Unidade $unidade)
    {
        return response()->json($unidade);
    }
}
