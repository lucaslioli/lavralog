<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Safra;
use App\Incidente;

class IncidenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Safra $safra)
    {
        $incidente = Incidente::where('safra_id', $safra->id)->get();

        return response()->json($incidente);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $incidente = Incidente::create([
            'data' => $request->data,
            'descricao' => $request->descricao,
            'safra_id' => $request->safra_id
        ]);

        return response()->json([
            'msg' => 'Incidente criado com sucesso!',
            'incidente' => $incidente
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Incidente $incidente)
    {
        return response()->json($incidente);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidente $incidente)
    {
        $incidente->data = $request->data;
        $incidente->descricao = $request->descricao;
        $incidente->safra_id = $request->safra_id;

        $incidente->save();

        return response()->json([
            'msg' => 'Incidente atualizada com sucesso!',
            'incidente' => $incidente
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidente $incidente)
    {
        $incidente->delete();

        return response()->json('Incidente deletada com sucesso!');
    }
}
