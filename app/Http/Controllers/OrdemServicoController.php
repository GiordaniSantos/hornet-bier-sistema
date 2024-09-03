<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\OrdemServico;
use App\Models\Problema;
use App\Models\OrdemServicoProblema;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordemServicos = OrdemServico::orderBy('created_at', 'desc')->get();

        confirmDelete('Deletar Ordem de Serviço!', "Você tem certeza que quer deletar este registro?");
        return view('admin.ordem-servico.index', ['ordemServicos' => $ordemServicos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $problemas = Problema::all();

        return view('admin.ordem-servico.create', ['clientes' => $clientes, 'problemas' => $problemas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(OrdemServico::rules(), OrdemServico::feedback());
        $ordemServico = new OrdemServico();
        $ordemServicoCriado = $ordemServico->create($request->all());
        if($ordemServicoCriado){
            foreach($request->problema_id as $problema){
                $ordemProblema = new OrdemServicoProblema;
                $ordemProblema->ordem_servico_id = $ordemServicoCriado->id;
                $ordemProblema->problema_id = $problema;
                $ordemProblema->save();
            }
            alert()->success('Concluído','Ordem de Serviço criada com sucesso.');
        }
        return redirect()->route('ordem-servico.show', ['ordem_servico' => $ordemServicoCriado]);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrdemServico $ordemServico)
    {
        return view('admin.ordem-servico.view', ['ordemServico' => $ordemServico]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdemServico $ordemServico)
    {
        $clientes = Cliente::all();
        $problemas = Problema::all();
        
        return view('admin.ordem-servico.edit', ['ordemServico' => $ordemServico, 'clientes' => $clientes, 'problemas' => $problemas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrdemServico $ordemServico)
    {   
        $request->validate(OrdemServico::rules(), OrdemServico::feedback());

        OrdemServicoProblema::where('ordem_servico_id', $request->idOs)->delete();
  
        foreach($request->problema_id as $problema){
            $ordemProblema = new OrdemServicoProblema;
            $ordemProblema->ordem_servico_id = $request->idOs;
            $ordemProblema->problema_id = $problema;
            $ordemProblema->save();
        }
        $ordemServico->data_saida = null;
        if($request->data_saida){
            $ordemServico->data_saida = date('Y-m-d', strtotime(str_replace('/', '-', $request->data_saida)));
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
        $ordemServico->delete();

        alert()->success('Concluído','Ordem de Serviço excluida com sucesso.');
        return redirect()->route('ordem-servico.index');
    }

    public function enviarOrcamentoWhatsapp($id)
    {
        $ordemServico = OrdemServico::where(['id' => $id])->first();
        if(!$ordemServico->cliente->celular){
            alert()->error('Erro','O cliente não tem um celular cadastrado.');
        }

        $whats = preg_replace('/[^0-9]/i', '', $ordemServico->cliente->celular);
        $mensagem = 'Olá '.$ordemServico->cliente->nome.', para acessar seu orçamento de ordem de serviço n° '.$ordemServico->numero.' e acompanhar o status do andamento do serviço basta acessar o seguinte link: '.route('orcamento', ['id' => $ordemServico->id]);

        $msg = urlencode($mensagem);
        $url = "https://web.whatsapp.com/send?phone=55{$whats}&text={$msg}";

        return redirect()->away($url)->withHeaders([
            'target' => '_blank',
        ]);
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
}
