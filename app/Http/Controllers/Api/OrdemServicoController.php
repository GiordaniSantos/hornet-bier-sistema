<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrdemServico;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrdemServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = OrdemServico::query()->with(['cliente' => function($query) {
            $query->select('id', 'nome');
        }]);
        
        $query->select('id', 'status', 'numero', 'valor_total', 'data_entrada', 'data_saida', 'cliente_id');
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('cliente_id') && $request->cliente_id != '') {
            $query->where('cliente_id', $request->cliente_id);
        }
        
        $ordemServicos = $query->orderBy('created_at', 'desc')->paginate(10);

        $ordemServicos->getCollection()->transform(function($item) {
            return [
                'id' => $item->id,
                'numero' => $item->numero,
                'status' => $item->getStatusFormatado(),
                'valor_total' => $item->valor_total,
                'data_entrada' => Carbon::parse($item->data_entrada)->format('d/m/Y'),
                'data_saida' => Carbon::parse($item->data_saida)->format('d/m/Y'),
                'cliente_nome' => $item->cliente->nome ?? null,
            ];
        });
        
        return response()->json($ordemServicos, 200);
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
     * @param  \App\Models\OrdemServico  $ordemservico
     * @return \Illuminate\Http\Response
     */
    public function show(OrdemServico $ordemServico)
    {
        return response()->json($ordemServico, 200);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdemServico  $ordemservico
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
     $ordemServico = OrdemServico::with(['cliente', 'pecas', 'problemas', 'servicos'])->where('id', $id)->first();

     if (!$ordemServico) {
         return response()->json(['message' => 'Ordem de serviço não encontrada'], 404);
     }

    $problemasString = "";
    foreach ($ordemServico->problemas as $problema) {
        $problemasString .= $problema->nome . "\n";
    }

    $servicosString = "Desmontagem\nLimpeza\n";
    foreach ($ordemServico->servicos as $servico) {
        $servicosString .= $servico->nome . "\n";
    }
    $servicosString .= "Ajuste da temperatura de 0 a - 1 grau";


    $pecasString = '';
    $valorTotal = 0;
    foreach ($ordemServico->pecas as $peca) {
        $valorPeca = $peca->pivot->valor_peca * $peca->pivot->quantidade;
        $valorTotal += $valorPeca;
        $pecasString .= "{$peca->nome} - R$" . number_format($peca->pivot->valor_peca, 2, ',', '.') . " x {$peca->pivot->quantidade} = R$" . number_format($valorPeca, 2, ',', '.') . "\n";
    }
    $pecasString .= "\nValor Total de Peças: R$" . number_format($valorTotal, 2, ',', '.');
 

     $dadosTransformados = [
        'id' => $ordemServico->id,
        'numero' => $ordemServico->numero,
        'marca' => $ordemServico->marca->nome ?? null,
        'modelo' => $ordemServico->modelo,
        'serie' => $ordemServico->serie,
        'numero_motor' => $ordemServico->numero_motor,
        'cliente' => $ordemServico->cliente->nome,
        'problemas' => $problemasString,
        'pecas' => $pecasString,
        'servicos' => $servicosString,
        'valor_mao_de_obra' => $ordemServico->valor,
        'valor_total' => $ordemServico->valor_total,
        'status' => $ordemServico->getStatusFormatado(),
        'data_entrada' => Carbon::parse($ordemServico->data_entrada)->format('d/m/Y'),
        'data_saida' => Carbon::parse($ordemServico->data_saida)->format('d/m/Y'),
        'observacao' => $ordemServico->observacao,
        'data_criacao' => $ordemServico->created_at,
        'data_modificacao' => $ordemServico->updated_at
     ];
 
     return response()->json($dadosTransformados, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrdemServico  $ordemservico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\OrdemServico $ordemservico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}