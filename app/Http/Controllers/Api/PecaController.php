<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peca;
use Illuminate\Http\Request;

class PecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pecas = Peca::select('id', 'nome', 'valor_unitario', 'created_at')->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($pecas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $peca = new Peca();
        $valor = str_replace('.', '', $request->valor_unitario);
        $valor = str_replace(',', '.', $valor);
        $request['valor_unitario'] = $valor;
        $pecaCriada = $peca->create($request->all());

        return response()->json($pecaCriada, 201);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peca  $peca
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peca = Peca::select('id', 'nome', 'valor_unitario')->where('id', $id)->first();
        return response()->json($peca, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peca  $peca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peca $peca)
    {
        $valor = str_replace('.', '', $request->valor_unitario);
        $valor = str_replace(',', '.', $valor);
        $request['valor_unitario'] = $valor;
        $peca->update($request->all());
        return response()->json($peca, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Peca $peca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peca $peca)
    {
        $peca->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}