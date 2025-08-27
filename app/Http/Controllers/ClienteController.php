<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Repositories\ClienteRepository;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = ClienteRepository::all('created_at', 'desc');

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
    public function store(ClienteRequest $request)
    {
        $clienteCriado = ClienteRepository::create($request->all());

        if ($clienteCriado) {
            alert()->success('Concluído', 'Cliente adicionado com sucesso.');
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
    public function update(ClienteRequest $request, Cliente $cliente)
    {   
        ClienteRepository::update($cliente, $request->all());
        alert()->success('Concluído','Cliente atualizado com sucesso.');
        return view('admin.cliente.view', ['cliente' => $cliente]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        try {
            ClienteRepository::delete($cliente);
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
