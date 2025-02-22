<?php

namespace App\Http\Controllers;

use App\Enums\StatusPagamento;
use App\Enums\TaxaPagamento;
use App\Models\OrdemServico;
use App\Models\Pagamento;
use App\Models\PagamentoItem;
use MP;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckoutController extends Controller
{
    public function checkoutOrdemServico(Request $request, $id)
    {
        if(!$request->get('taxa')){
            alert()->error('Erro','É preciso informar se haverá taxa ou não na cobrança.');
            return redirect()->route('ordem-servico.index');
        }

        $ordemServico = OrdemServico::where(['id' => $id])->first();

        if(!$ordemServico){
            alert()->error('Erro','Ordem de serviço não encontrada.');
            return redirect()->route('ordem-servico.index');
        }

        $lineItems = [];
        $totalPrice = 0;
        $taxa = $this->calcularTaxa(TaxaPagamento::from($request->get('taxa')), $ordemServico->valor_total);

        $totalPrice = $ordemServico->valor_total + $taxa;
        $lineItems[] = [
            'title' => 'Ordem de Serviço n° '.$ordemServico->numero,
            "currency_id" => "BRL",
            'unit_price' => doubleval($totalPrice),
            'quantity' => 1,
        ];
        
        $preference_data = array (
            "items" => $lineItems,
            "payer" => array (
                "name" =>  $ordemServico->cliente->nome,
                "email" => $ordemServico->cliente->email ? $ordemServico->cliente->email : '',
                "identification" => array (
                   "type" => "CPF",
                    "number" => $ordemServico->cliente->cpf_cnpj ? $ordemServico->cliente->cpf_cnpj : ''
                )
            ),
            "back_urls" => array (
                "failure" => route('checkout.failure', [], true),
                "pending" => "",
                "success" => route('checkout.success', [], true)
            )
        );
 
        $preference = MP::create_preference($preference_data);

        $paymentData = [
            'valor' => $totalPrice,
            'status' => StatusPagamento::Pendente,
            'tipo_taxa' => TaxaPagamento::from($request->get('taxa')),
            'valor_taxa' => $taxa,
            'session_id' => $preference['response']['id']
        ];
        $pagamento = Pagamento::create($paymentData);

        $itemPagamento = [
            'valor_item' => $ordemServico->valor_total,
            'cliente_id' => $ordemServico->cliente->id,
            'ordem_servico_id' => $ordemServico->id,
            'pagamento_id' => $pagamento->id,
        ];
        PagamentoItem::create($itemPagamento);

        try {
            
            return redirect()->away($pagamento->getWhatsappLinkPagamento($preference['response']['init_point'], false))->withHeaders([
                'target' => '_blank',
            ]);
        } catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    public function checkoutMultiploOrdemServico(Request $request)
    {
        if(!$request->get('taxa')){
            abort(500, 'É preciso informar se haverá taxa ou não na cobrança.');
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:ordem_servicos,id',
        ]);

        $ids = $request->input('ids');

        $ordensServicos = OrdemServico::whereIn('id', $ids)->with('cliente')
        ->whereHas('cliente', function($query) {
            $query->whereNotNull('celular')->where('celular', '!=', '');
        })
        ->get();

        if ($ordensServicos->isEmpty()) {
            abort(400, 'Nenhuma ordem de serviço encontrada.');
        }

        $lineItems = [];
        $totalPrice = 0;
        $itensPagamento = [];

        foreach($ordensServicos as $ordemServico){
            $totalPrice += $ordemServico->valor_total;
            $lineItems[] = [
                'title' => 'Ordem de Serviço n° '.$ordemServico->numero,
                "currency_id" => "BRL",
                'unit_price' => doubleval($ordemServico->valor_total),
                'quantity' => 1,
            ];
    
            $itensPagamento[] = [
                'valor_item' => $ordemServico->valor_total,
                'cliente_id' => $ordemServico->cliente->id,
                'ordem_servico_id' => $ordemServico->id,
            ];
        }

        $taxa = $this->calcularTaxa(TaxaPagamento::from($request->get('taxa')), $totalPrice);
        $totalPrice += $taxa;

        if ($taxa > 0) {
            $lineItems[] = [
                'title' => 'Taxa da Máquina',
                "currency_id" => "BRL",
                'unit_price' => doubleval($taxa),
                'quantity' => 1,
            ];
        }

        $preference_data = array (
            "items" => $lineItems,
            "payer" => array (
                "name" =>  $ordensServicos[0]['cliente']['nome'],
                "email" => $ordensServicos[0]['cliente']['email'] ? $ordensServicos[0]['cliente']['email'] : '',
                "identification" => array (
                   "type" => "CPF",
                    "number" => $ordensServicos[0]['cliente']['cpf_cnpj'] ? $ordensServicos[0]['cliente']['cpf_cnpj'] : ''
                )
            ),
            "back_urls" => array (
                "failure" => route('checkout.failure', [], true),
                "pending" => "",
                "success" => route('checkout.success', [], true)
            )
        );
 
        $preference = MP::create_preference($preference_data);

        $paymentData = [
            'valor' => $totalPrice,
            'status' => StatusPagamento::Pendente,
            'tipo_taxa' => TaxaPagamento::from($request->get('taxa')),
            'valor_taxa' => $taxa,
            'session_id' => $preference['response']['id']
        ];
        $pagamento = Pagamento::create($paymentData);

        foreach ($itensPagamento as $itemPagamento) {
            $itemPagamento['pagamento_id'] = $pagamento->id;
            PagamentoItem::create($itemPagamento);
        }

        try {
            return response()->json(['url' => $pagamento->getWhatsappLinkPagamento($preference['response']['init_point'], false)]);
        } catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    public function success(Request $request)
    {
        try {
            $session_id = $request->get('preference_id');

            $payment = Pagamento::query()->where(['session_id' => $session_id])->first();

            if (!$payment) {
                throw new NotFoundHttpException();
            }

            $payment->tipo = $request->get('payment_type');
            if ($payment->status === StatusPagamento::Pendente->value) {
                $payment->status = StatusPagamento::Pago->value;
                $payment->update();
            }
            
            return view('checkout.success', [
                'pagamento' => $payment
            ]);
        } catch (\Exception $e) {
            return view('checkout.failure', ['message' => $e->getMessage()]);
        }
    }

    public function failure(Request $request)
    {
        try {
            $session_id = $request->get('preference_id');

            $payment = Pagamento::query()->where(['session_id' => $session_id])->first();

            $payment->tipo = $request->get('payment_type');

            if ($payment->status === StatusPagamento::Pendente->value) {
                $payment->status = StatusPagamento::Falhou->value;
                $payment->update();
            }
            
            return view('checkout.failure', [
                'pagamento' => $payment
            ]);
        } catch (\Exception $e) {
            return view('checkout.failure', ['message' => $e->getMessage()]);
        }
    }

    public function calcularTaxa(TaxaPagamento $tipoTaxa, float $valor): float
    {
        switch ($tipoTaxa) {
            case TaxaPagamento::Nao:
                return 0;
            case TaxaPagamento::CartaoCredito:
                return $valor * 0.0531;
            case TaxaPagamento::CartaoDebito:
                return $valor * 0.0399;
            case TaxaPagamento::Boleto:
                return 3.49;
            case TaxaPagamento::Pix:
                return $valor * 0.0099;
            default:
                throw new InvalidArgumentException("Tipo de taxa inválido.");
        }
    }
}
