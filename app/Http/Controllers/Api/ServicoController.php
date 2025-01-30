<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servico;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $termo = $request->input('termo');

        $query = Servico::select('id', 'nome', 'created_at');

        if ($termo) {
            $query->whereRaw('LOWER(nome) LIKE ?', ['%' . strtolower($termo) . '%']);
        }

        $servicos = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($servicos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $servico = new Servico();
        $servicoCriado = $servico->create($request->all());

        return response()->json($servicoCriado, 201);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servico = Servico::select('id', 'nome')->where('id', $id)->first();
        return response()->json($servico, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servico  $servico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servico $servico)
    {
        $servico->update($request->all());
        return response()->json($servico, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Servico $servico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servico $servico)
    {
        $servico->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}