<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insumo;

class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insumo = Insumo::all();

        return response()->json($insumo);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insumo = Insumo::create([
            'descricao' => $request->descricao,
            'insumos_tipo_id' => $request->insumos_tipo_id
        ]);

        return response()->json([
            'msg' => 'Insumo criado com sucesso!',
            'insumo' => $insumo
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Insumo $insumo)
    {
        return response()->json($insumo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insumo $insumo)
    {
        $insumo->descricao = $request->descricao;
        $insumo->insumos_tipo_id = $request->insumos_tipo_id;

        $insumo->save();

        return response()->json([
            'msg' => 'Insumo atualizada com sucesso!',
            'Insumo' => $insumo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insumo $insumo)
    {
        $insumo->delete();

        return response()->json('Insumo deletada com sucesso!');
    }

    public function safras(Insumo $insumo){
        return response()->json($insumo->safras);
    }
}
