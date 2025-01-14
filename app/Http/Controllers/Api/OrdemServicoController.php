<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusOrdemServico;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Marca;
use App\Models\OrdemServico;
use App\Models\OrdemServicoPeca;
use App\Models\OrdemServicoProblema;
use App\Models\OrdemServicoServico;
use App\Models\Peca;
use App\Models\Problema;
use App\Models\Servico;
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
        $request->validate(OrdemServico::rules(), OrdemServico::feedback());

        $ordemServico = new OrdemServico();
        if($request->valor){
            $valor = str_replace('.', '', $request->valor);
            $valor = str_replace(',', '.', $valor);
            $request['valor'] = $valor;
        }

        $ordemServicoCriado = $ordemServico->create($request->all());
        if ($request->data_entrada) {
            $ordemServicoCriado->data_entrada = Carbon::parse($request->data_entrada)->format('Y-m-d');
        }
        if ($request->data_saida) {
            $ordemServicoCriado->data_saida = Carbon::parse($request->data_saida)->format('Y-m-d');
        }
        $valorTotal = $request->valor;

        if($ordemServicoCriado){
            if($request->pecas && isset($request->pecas[0]['peca_id'])){
                foreach($request->pecas as $peca){
                    $ordemPeca = new OrdemServicoPeca;
                    $ordemPeca->ordem_servico_id = $ordemServicoCriado->id;
                    $ordemPeca->peca_id = $peca['peca_id'];
                    $ordemPeca->quantidade = $peca['quantidade'];
                    $ordemPeca->valor_peca = $peca['valor_unitario'];
                    $ordemPeca->save();
                    $valorTotal += $peca['valor_unitario'] * $peca['quantidade'];
                }
            }
            $ordemServicoCriado->valor_total = $valorTotal;
            $ordemServicoCriado->save();

            foreach($request->problema_id as $problema){
                $ordemProblema = new OrdemServicoProblema;
                $ordemProblema->ordem_servico_id = $ordemServicoCriado->id;
                $ordemProblema->problema_id = $problema;
                $ordemProblema->save();
            }

            if($request->servico_id){
                foreach($request->servico_id as $servicoId){
                    $servico = new OrdemServicoServico;
                    $servico->ordem_servico_id = $ordemServicoCriado->id;
                    $servico->servico_id = $servicoId;
                    $servico->save();
                }
            }
        }
        
        return response()->json($ordemServicoCriado, 201);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdemServico  $ordemservico
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ordemServico = OrdemServico::with(['cliente', 'marca', 'problemas', 'servicos', 'pecas'])->where('id', $id)->first();

        if (!$ordemServico) {
            return response()->json(['message' => 'Ordem de serviço não encontrada'], 404);
        }

        $dadosTransformados = [
            'id' => $ordemServico->id,
            'numero' => $ordemServico->numero,
            'marca' => $ordemServico->marca->id ?? null,
            'modelo' => $ordemServico->modelo,
            'serie' => $ordemServico->serie,
            'numero_motor' => $ordemServico->numero_motor,
            'cliente' => $ordemServico->cliente->id ?? null,
            'problemas' => $ordemServico->problemas->pluck('id')->toArray(),
            'servicos' => $ordemServico->servicos->pluck('id')->toArray(),
            'pecas' => $ordemServico->pecas->map(function($peca, $index) {
                return [
                    'id' => $index + 1,
                    'peca_id' => $peca->id,
                    'quantidade' => $peca->pivot->quantidade,
                    'valor_unitario' => $peca->valor_unitario,
                ];
            })->toArray(),
            'valorMaoDeObra' => $ordemServico->valor,
            'status' => $ordemServico->status,
            'valorTotal' => $ordemServico->valor_total,
            'dataEntrada' => Carbon::parse($ordemServico->data_entrada)->toDateString(),
            'dataSaida' => Carbon::parse($ordemServico->data_saida)->toDateString()
        ];

        return response()->json($dadosTransformados, 200);
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

    public function recursos(Request $request)
    {
        $clientes = Cliente::select('id', 'nome')->get();
        $problemas = Problema::select('id', 'nome')->get();
        $pecas = Peca::select('id', 'nome', 'valor_unitario')->get();
        $servicos = Servico::select('id', 'nome')->get();
        $marcas = Marca::select('id', 'nome')->get();

        $status = [];
        if($request->withStatus){
            foreach(StatusOrdemServico::cases() as $case){
                $status[] = [
                    'value' => $case->value,
                    'descricao' => StatusOrdemServico::getDescription($case->value)
                ];
            }
        }

        return response()->json(['clientes' => $clientes, 'problemas' => $problemas, 'pecas' => $pecas, 'servicos' => $servicos, 'marcas' => $marcas, 'status' => $status], 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrdemServico  $ordemservico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdemServico $ordemServico)
    {
        $request->validate(OrdemServico::rules(), OrdemServico::feedback());
        if($request->valor){
            $valor = str_replace('.', '', $request->valor);
            $valor = str_replace(',', '.', $valor);
            $request['valor'] = $valor;
        }

        $valorTotal = $request->valor;
        OrdemServicoPeca::where('ordem_servico_id', $request->idOs)->delete();
        if($request->pecas && isset($request->pecas[0]['peca_id'])){

            foreach($request->pecas as $peca){
                $ordemPeca = new OrdemServicoPeca;
                $ordemPeca->ordem_servico_id = $request->idOs;
                $ordemPeca->peca_id = $peca['peca_id'];
                $ordemPeca->quantidade = $peca['quantidade'];
                $ordemPeca->valor_peca = $peca['valor_unitario'];
                $ordemPeca->save();
                $valorTotal += $peca['valor_unitario'] * $peca['quantidade'];
            }
        }
        $ordemServico->valor_total = $valorTotal;

        if($request->problema_id){
            OrdemServicoProblema::where('ordem_servico_id', $request->idOs)->delete();

            foreach($request->problema_id as $problema){
                $ordemProblema = new OrdemServicoProblema;
                $ordemProblema->ordem_servico_id = $request->idOs;
                $ordemProblema->problema_id = $problema;
                $ordemProblema->save();
            }
        }

        OrdemServicoServico::where('ordem_servico_id', $request->idOs)->delete();
        if($request->servico_id){
            foreach($request->servico_id as $servicoId){
                $servico = new OrdemServicoServico;
                $servico->ordem_servico_id = $request->idOs;
                $servico->servico_id = $servicoId;
                $servico->save();
            }
        }

        $ordemServico->data_saida = null;
        if ($request->data_entrada) {
            $ordemServico->data_entrada = Carbon::parse($request->data_entrada)->format('Y-m-d');
        }
        if ($request->data_saida) {
            $ordemServico->data_saida = Carbon::parse($request->data_saida)->format('Y-m-d');
        }
        $ordemServico->update($request->all());
        return response()->json($ordemServico, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\OrdemServico $ordemservico
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdemServico $ordemServico)
    {
        OrdemServicoProblema::where('ordem_servico_id', $ordemServico->id)->delete();
        OrdemServicoPeca::where('ordem_servico_id', $ordemServico->id)->delete();
        OrdemServicoServico::where('ordem_servico_id', $ordemServico->id)->delete();
        $ordemServico->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}