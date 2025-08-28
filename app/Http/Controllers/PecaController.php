<?php

namespace App\Http\Controllers;

use App\Models\Peca;
use App\Services\PecaService;
use Illuminate\Http\Request;

class PecaController extends Controller
{
    protected PecaService $pecaService;

    public function __construct(PecaService $pecaService)
    {
        $this->pecaService = $pecaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pecas = $this->pecaService->all('created_at', 'desc');

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
        $pecaCriada = $this->pecaService->createPeca($request->all());
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
        $this->pecaService->updatePeca($peca, $request->all());
        alert()->success('Concluído','Peça atualizada com sucesso.');
        return redirect()->route('peca.index', ['peca' => $peca->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peca $peca)
    {
        try {
            $this->pecaService->delete($peca);
            alert()->success('Concluído','Peça removida com sucesso.');
            return redirect()->route('peca.index');
        } catch (\Exception $e) {
            alert()->error('Erro', $e->getMessage());
            return redirect()->route('peca.index');
        }
    }
}
