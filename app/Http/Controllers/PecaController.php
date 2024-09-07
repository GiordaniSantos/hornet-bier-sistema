<?php

namespace App\Http\Controllers;

use App\Models\Peca;
use Illuminate\Http\Request;

class PecaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pecas = Peca::orderBy('created_at', 'desc')->get();

        confirmDelete('Deletar peça!', "Você tem certeza que quer deletar este registro?");
        return view('admin.peca.index', ['pecas' => $pecas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.peca.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $peca = new Peca();
        $valor = str_replace('.', '', $request->valor_unitario);
        $valor = str_replace(',', '.', $valor);
        $request['valor_unitario'] = $valor;
        $pecaCriada = $peca->create($request->all());
        if($pecaCriada){
            alert()->success('Concluído','Peça adicionada com sucesso.');
        }
        return redirect()->route('peca.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peca $peca)
    {
        return view('admin.peca.view', ['peca' => $peca]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peca $peca)
    {
        return view('admin.peca.edit', ['peca' => $peca]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peca $peca)
    {
        $valor = str_replace('.', '', $request->valor_unitario);
        $valor = str_replace(',', '.', $valor);
        $request['valor_unitario'] = $valor;
        $peca->update($request->all());
        alert()->success('Concluído','Peca atualizado com sucesso.');
        return redirect()->route('peca.index', ['peca' => $peca->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peca $peca)
    {
        $peca->delete();
  
        alert()->success('Concluído','Peca removido com sucesso.');
        return redirect()->route('peca.index');
    }
}
