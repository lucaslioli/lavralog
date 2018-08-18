<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lavoura;
use App\User;

class LavouraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $lavoura = Lavoura::where('user_id', $user->id)->first();

        return response()->json($lavoura);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lavoura = Lavoura::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'area' => $request->area,
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'msg' => 'Lavoura criada com sucesso!',
            'lavoura' => $lavoura
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
