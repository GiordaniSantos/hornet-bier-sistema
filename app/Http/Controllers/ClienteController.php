<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::orderBy('created_at', 'desc')->get();

        confirmDelete('Deletar cliente!', "Você tem certeza que quer deletar este registro?");
        return view('admin.cliente.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Cliente::rules(), Cliente::feedback());
        $cliente = new Cliente();
        $clienteCriado = $cliente->create($request->all());
        if($clienteCriado){
            alert()->success('Concluído','Cliente adicionado com sucesso.');
        }
        return view('admin.cliente.view', ['cliente' => $clienteCriado]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return view('admin.cliente.view', ['cliente' => $cliente]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('admin.cliente.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {   
        $request->validate(Cliente::rules($cliente), Cliente::feedback());
        $cliente->update($request->all());
        alert()->success('Concluído','Cliente atualizado com sucesso.');
        return view('admin.cliente.view', ['cliente' => $cliente]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
            alert()->success('Concluído','Cliente removido com sucesso.');
            return redirect()->route('cliente.index');
        } catch (\Exception $e) {
            alert()->error('Erro', $e->getMessage());
            if ($e instanceof \Illuminate\Database\QueryException) {
                alert()->error('Erro', 'Erro ao remover o cliente. Existem ordens de serviço associadas a este cliente.');
            }
            return redirect()->route('cliente.index');
        }
    }
}
