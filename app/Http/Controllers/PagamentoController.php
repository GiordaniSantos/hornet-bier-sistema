<?php

namespace App\Http\Controllers;

use App\Enums\StatusPagamento;
use App\Models\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagamentos = Pagamento::orderBy('created_at', 'desc')->get();

        confirmDelete('Deletar pagamento!', "Você tem certeza que quer deletar este registro?");
        return view('admin.pagamento.index', ['pagamentos' => $pagamentos]);
    }

    public function setStatusPagamento($id)
    {
        $pagamento = Pagamento::where('id', $id)->first();
        if (!$pagamento) {
            alert()->error('Erro', 'Pagamento não encontrado.');
            return redirect()->route('pagamento.index');
        }
        $pagamento->status = $pagamento->status == StatusPagamento::Pago->value ? StatusPagamento::Pendente->value : StatusPagamento::Pago->value;
        $pagamento->save();
 
        alert()->success('Concluído','Status alterado com sucesso.');
        return redirect()->route('pagamento.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pagamento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Pagamento $pagamento)
    {
        return view('admin.pagamento.view', ['pagamento' => $pagamento]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pagamento $pagamento)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pagamento $pagamento)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pagamento $pagamento)
    {
        try {
            $pagamento->delete();
            alert()->success('Concluído','Pagamento removido com sucesso.');
            return redirect()->route('pagamento.index');
        } catch (\Exception $e) {
            alert()->error('Erro', $e->getMessage());
            return redirect()->route('pagamento.index');
        }
    }
}
