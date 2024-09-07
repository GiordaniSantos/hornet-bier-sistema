<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicos = Servico::orderBy('created_at', 'desc')->get();

        confirmDelete('Deletar serviço!', "Você tem certeza que quer deletar este registro?");
        return view('admin.servico.index', ['servicos' => $servicos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.servico.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $servico = new Servico();
        $servicoCriada = $servico->create($request->all());
        if($servicoCriada){
            alert()->success('Concluído','Serviço adicionado com sucesso.');
        }
        return redirect()->route('servico.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servico $servico)
    {
        return view('admin.servico.view', ['servico' => $servico]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico)
    {
        return view('admin.servico.edit', ['servico' => $servico]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servico $servico)
    {
        $servico->update($request->all());
        alert()->success('Concluído','Serviço atualizado com sucesso.');
        return redirect()->route('servico.index', ['servico' => $servico->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servico $servico)
    {
        $servico->delete();
  
        alert()->success('Concluído','Servico removido com sucesso.');
        return redirect()->route('servico.index');
    }
}
