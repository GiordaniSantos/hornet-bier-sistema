<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::orderBy('created_at', 'desc')->get();

        confirmDelete('Deletar marca!', "Você tem certeza que quer deletar este registro?");
        return view('admin.marca.index', ['marcas' => $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.marca.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Marca::rules(), Marca::feedback());
        $marca = new Marca();
        $marcaCriado = $marca->create($request->all());
        if($marcaCriado){
            alert()->success('Concluído','Marca adicionada com sucesso.');
        }
        return view('admin.marca.view', ['marca' => $marcaCriado]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        return view('admin.marca.view', ['marca' => $marca]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        return view('admin.marca.edit', ['marca' => $marca]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        $request->validate(Marca::rules(), Marca::feedback());
        $marca->update($request->all());
        alert()->success('Concluído','Marca atualizada com sucesso.');
        return view('admin.marca.view', ['marca' => $marca]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        try {
            $marca->delete();
            alert()->success('Concluído','Marca removida com sucesso.');
            return redirect()->route('marca.index');
        } catch (\Exception $e) {
            alert()->error('Erro', $e->getMessage());
            if ($e instanceof \Illuminate\Database\QueryException) {
                alert()->error('Erro', 'Erro ao remover a Marca. Existem ordens de serviço associadas a esta Marca.');
            }
            return redirect()->route('marca.index');
        }
    }
}
