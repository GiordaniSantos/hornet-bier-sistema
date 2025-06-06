<?php

namespace App\Http\Controllers;

use App\Enums\StatusPagamento;
use App\Enums\TaxaPagamento;
use App\Models\Cliente;
use App\Models\Helper;
use App\Models\Marca;
use App\Models\OrdemServico;
use App\Models\OrdemServicoPeca;
use App\Models\Problema;
use App\Models\OrdemServicoProblema;
use App\Models\OrdemServicoServico;
use App\Models\Pagamento;
use App\Models\PagamentoItem;
use App\Models\Peca;
use App\Models\Servico;
use MP;
use Illuminate\Http\Request;
use LaravelQRCode\Facades\QRCode;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrdemServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clientes = Cliente::all();
        $query = OrdemServico::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('cliente_id') && $request->cliente_id != '') {
            $query->where('cliente_id', $request->cliente_id);
        }

        $ordemServicos = $query->orderBy('created_at', 'desc')->get();

        confirmDelete('Deletar Ordem de Serviço!', "Você tem certeza que quer deletar este registro?");

        $inputOptionsTaxas = TaxaPagamento::getInputOptions();

        return view('admin.ordem-servico.index', ['ordemServicos' => $ordemServicos, 'clientes' => $clientes, 'inputOptionsTaxas' => $inputOptionsTaxas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $problemas = Problema::all();
        $pecas = Peca::all();
        $servicos = Servico::all();
        $marcas = Marca::all();

        return view('admin.ordem-servico.create', ['clientes' => $clientes, 'problemas' => $problemas, 'pecas' => $pecas, 'servicos' => $servicos, 'marcas' => $marcas]);
    }

    /**
     * Store a newly created resource in storage.
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
        if($request->data_entrada){
            $ordemServicoCriado->data_entrada = date('Y-m-d', strtotime(str_replace('/', '-', $request->data_entrada)));
        }
        if($request->data_saida){
            $ordemServicoCriado->data_saida = date('Y-m-d', strtotime(str_replace('/', '-', $request->data_saida)));
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
            alert()->success('Concluído','Ordem de Serviço criada com sucesso.');
        }
        return redirect()->route('ordem-servico.edit', ['ordem_servico' => $ordemServicoCriado]);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrdemServico $ordemServico)
    {
        confirmDelete('Deletar Ordem de Serviço!', "Você tem certeza que quer deletar este registro?");

        return view('admin.ordem-servico.view', ['ordemServico' => $ordemServico]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdemServico $ordemServico)
    {
        $clientes = Cliente::all();
        $problemas = Problema::all();
        $pecas = Peca::all();
        $servicos = Servico::all();
        $marcas = Marca::all();

        return view('admin.ordem-servico.edit', ['ordemServico' => $ordemServico, 'clientes' => $clientes, 'problemas' => $problemas, 'pecas' => $pecas, 'servicos' => $servicos, 'marcas' => $marcas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrdemServico $ordemServico)
    {
        //dd($request->pecas);
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
        if($request->data_saida){
            $ordemServico->data_saida = date('Y-m-d', strtotime(str_replace('/', '-', $request->data_saida)));
        }
        if($request->data_entrada){
            $ordemServico->data_entrada = date('Y-m-d', strtotime(str_replace('/', '-', $request->data_entrada)));
        }
        $ordemServico->update($request->all());
        alert()->success('Concluído','Ordem de Serviço atualizado com sucesso.');
        return redirect()->route('ordem-servico.show', ['ordem_servico' => $ordemServico->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrdemServico $ordemServico)
    {
        OrdemServicoProblema::where('ordem_servico_id', $ordemServico->id)->delete();
        OrdemServicoPeca::where('ordem_servico_id', $ordemServico->id)->delete();
        OrdemServicoServico::where('ordem_servico_id', $ordemServico->id)->delete();
        $ordemServico->delete();

        alert()->success('Concluído','Ordem de Serviço excluida com sucesso.');
        return redirect()->route('ordem-servico.index');
    }

    public function fecharOrdemServico(Request $request, $id)
    {
        try {
            $ordemServico = OrdemServico::where(['id' => $id])->first();
            $ordemServico->status = $request->status;
            $ordemServico->data_entrada = $request->data_entrada;
            $ordemServico->data_saida = $request->data_saida;
            $ordemServico->save();
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function enviarOrcamentoWhatsapp($id)
    {
        $ordemServico = OrdemServico::where(['id' => $id])->first();
        if(!$ordemServico->cliente->celular){
            alert()->error('Erro','O cliente não tem um celular cadastrado.');
            return redirect()->route('ordem-servico.show', ['ordem_servico' => $ordemServico->id]);
        }

        return redirect()->away($ordemServico->getWhatsappLink())->withHeaders([
            'target' => '_blank',
        ]);
    }

    public function enviarMultiplosOrcamentoWhatsapp(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:ordem_servicos,id',
        ]);

        $ids = $request->input('ids');

        $ordensServicos = OrdemServico::whereIn('id', $ids)
        ->with('cliente')
        ->whereHas('cliente', function($query) {
            $query->whereNotNull('celular')->where('celular', '!=', '');
        })
        ->get();

        if ($ordensServicos->isEmpty()) {
            abort(400, 'O cliente não tem um celular cadastrado.');
        }

        $clientes = $ordensServicos->pluck('cliente_id');

        if ($clientes->unique()->count() > 1) {
            abort(400, 'Os orçamentos pertencem a clientes diferentes.');
        }

        $mensagemFormatada = Helper::formataMensagemWhatsapp($ordensServicos->toArray());

        return response()->json(['url' => Helper::getWhatsappUrl(Helper::getWhatsappCelular($ordensServicos[0]->cliente->celular), $mensagemFormatada)]);
    }

    public function enviarOrcamentoPorEmail($id)
    {
        $ordemServico = OrdemServico::where(['id' => $id])->first();
        if(!$ordemServico->cliente->email){
            alert()->error('Erro','O cliente não tem um email cadastrado.');
        }

        try {
            \Illuminate\Support\Facades\Mail::send(new \App\Mail\OrdemServico($ordemServico));
            alert()->success('Concluído','Email enviado com sucesso!');
        } catch (\Exception $e) {
            alert()->error('Erro', 'Erro ao enviar email: ' . $e->getMessage())->showConfirmButton('Confirmar', '#3085d6');
        }

        return redirect()->route('ordem-servico.show', ['ordem_servico' => $ordemServico->id]);
    }

    public function gerarQR($id)
    {
        $ordemServico = OrdemServico::where(['id' => $id])->first();
        if(!$ordemServico){
            alert()->error('Erro','Ordem de serviço não encontrado.');
        }
        $url = route('orcamento', ['id' => $ordemServico->id]);
        return QRCode::url($url)->png();
    }
}
