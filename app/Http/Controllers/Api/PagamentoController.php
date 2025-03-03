<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusPagamento;
use App\Enums\TaxaPagamento;
use App\Http\Controllers\Controller;
use App\Models\Pagamento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Pagamento::query()->with(['itens']);
        
        $query->select('id', 'status', 'tipo_taxa', 'valor', 'created_at');
        
        $pagamentos = $query->orderBy('created_at', 'desc')->paginate(10);

        $pagamentos->getCollection()->transform(function($item) {
            return [
                'id' => $item->id,
                'status' => $item->isPaid() ? 'Pago' : 'Não Pago',
                'tipo_taxa' => TaxaPagamento::getDescription($item->tipo_taxa),
                'valor' => number_format($item->valor, 2, ',', '.'),
                'itens' => $item->itens()->count(),
                'created_at' => Carbon::parse($item->created_at)->format('d/m/Y'),
            ];
        });
        
        return response()->json($pagamentos, 200);
    }

    public function setStatusPagamento($id)
    {
        $pagamento = Pagamento::where('id', $id)->first();
        if (!$pagamento) {
            abort(404, 'Pagamento não encontrado');
        }
        $pagamento->status = $pagamento->status == StatusPagamento::Pago->value ? StatusPagamento::Pendente->value : StatusPagamento::Pago->value;
        $pagamento->save();
 
        return response()->json($pagamento, 200);
    }

    public function getOptionsTaxaPagamento()
    {
        $inputOptionsTaxas = TaxaPagamento::getInputOptionsApi();

        return response()->json($inputOptionsTaxas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pagamento = Pagamento::with(['itens'])->where('id', $id)->first();

        if (!$pagamento) {
            abort(404, 'Pagamento não encontrado');
        }

        $itensFormatados = $pagamento->itens->map(function($item) {
            return "{$item->ordemServico->numero} - {$item->cliente->nome} - R$ " . number_format($item->valor, 2, ',', '.');
        });

        $pagamentoEstruturado = [
            'id' => $pagamento->id,
            'status' => $pagamento->isPaid() ? 'Pago' : 'Não Pago',
            'tipo_taxa' => TaxaPagamento::getDescription($pagamento->tipo_taxa),
            'valor' => number_format($pagamento->valor, 2, ',', '.'),
            'valor_taxa' => number_format($pagamento->valor_taxa, 2, ',', '.'),
            'itens' => $itensFormatados,
            'tipo_pagamento' => $pagamento->tipo_pagamento,
            'created_at' => Carbon::parse($pagamento->created_at)->format('d/m/Y'),
            'updated_at' => Carbon::parse($pagamento->updated_at)->format('d/m/Y'),
        ];

        return response()->json($pagamentoEstruturado, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pagamento  $pagamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pagamento $pagamento)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Pagamento $pagamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pagamento $pagamento)
    {
        $pagamento->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}