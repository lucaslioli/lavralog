<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lavoura;
use App\Safra;

class SafraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Lavoura $lavoura)
    {
        $safra = Safra::where('lavoura_id', $lavoura->id)->get();

        return response()->json($safra);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $safra = Safra::create([
            'cultura' => $request->cultura,
            'ano' => $request->ano,
            'unidade_id' => $request->unidade_id,
            'lavoura_id' => $request->lavoura_id
        ]);

        return response()->json([
            'msg' => 'Safra criada com sucesso!',
            'safra' => $safra
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Safra $safra)
    {
        return response()->json($safra);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Safra $safra)
    {
        $safra->cultura = $request->cultura;
        $safra->ano = $request->ano;
        $safra->producao = $request->producao;
        $safra->valor_unitario = $request->valor_unitario;
        $safra->receita_total = $request->receita_total;
        $safra->unidade_id = $request->unidade_id;
        $safra->lavoura_id = $request->lavoura_id;

        $safra->save();

        return response()->json([
            'msg' => 'Safra atualizada com sucesso!',
            'safra' => $safra
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Safra $safra)
    {
        $safra->delete();

        return response()->json('Safra deletada com sucesso!');
    }

    public function insumos(Safra $safra){
        return response()->json($safra->insumos);
    }
}
