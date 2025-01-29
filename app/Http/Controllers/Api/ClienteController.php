<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $termo = $request->input('termo');

        $query = Cliente::select('id', 'nome', 'nome_contato', 'cpf_cnpj');

        if ($termo) {
            $query->whereRaw('LOWER(nome) LIKE ?', ['%' . strtolower($termo) . '%']);
        }

        $clientes = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($clientes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Cliente::rules(), Cliente::feedback());
        $cliente = new Cliente();
        $clienteCriado = $cliente->create($request->all());

        return response()->json($clienteCriado, 201);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::where('id', $id)->first();
        return response()->json($cliente, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate(Cliente::rules(), Cliente::feedback());
        $cliente->update($request->all());
        return response()->json($cliente, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }

    public function selectClientes()
    {
        $clientes = Cliente::select('id', 'nome')->orderBy('nome', 'asc')->get();

        return response()->json($clientes, 200);
    }
}