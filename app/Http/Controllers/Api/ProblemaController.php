<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Problema;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProblemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $termo = $request->input('termo');

        $query = Problema::select('id', 'nome', 'created_at');

        if ($termo) {
            $query->whereRaw('LOWER(nome) LIKE ?', ['%' . strtolower($termo) . '%']);
        }

        $problemas = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($problemas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Problema::rules(), Problema::feedback());
        $problema = new Problema();
        $problemaCriado = $problema->create($request->all());

        return response()->json($problemaCriado, 201);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\Problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $problema = Problema::select('id', 'nome')->where('id', $id)->first();
        return response()->json($problema, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Problema  $problema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Problema $problema)
    {
        $problema->update($request->all());
        return response()->json($problema, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Problema $problema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Problema $problema)
    {
        $problema->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}