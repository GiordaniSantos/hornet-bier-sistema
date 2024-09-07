<?php

namespace App\Http\Controllers;

use App\Models\Problema;
use Illuminate\Http\Request;

class ProblemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $problemas = Problema::orderBy('created_at', 'desc')->get();

        confirmDelete('Deletar problema!', "Você tem certeza que quer deletar este registro?");
        return view('admin.problema.index', ['problemas' => $problemas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.problema.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Problema::rules(), Problema::feedback());
        $problema = new Problema();
        $problemaCriado = $problema->create($request->all());
        if($problemaCriado){
            alert()->success('Concluído','Problema adicionado com sucesso.');
        }
        return redirect()->route('problema.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Problema $problema)
    {
        return view('admin.problema.view', ['problema' => $problema]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Problema $problema)
    {
        return view('admin.problema.edit', ['problema' => $problema]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Problema $problema)
    {
        $problema->update($request->all());
        alert()->success('Concluído','Problema atualizado com sucesso.');
        return redirect()->route('problema.index', ['problema' => $problema->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Problema $problema)
    {
        try {
            $problema->delete();
            alert()->success('Concluído','Problema removido com sucesso.');
            return redirect()->route('problema.index');
        } catch (\Exception $e) {
            alert()->error('Erro', $e->getMessage());
            return redirect()->route('problema.index');
        }
    }
}
