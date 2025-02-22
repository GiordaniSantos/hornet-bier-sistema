<?php
use App\Enums\TaxaPagamento;
?>

@extends('layouts.app')

@section('titulo', 'Hornet Bier - Pagamentos')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Pagamentos</h1>
        <p class="mb-4">Aqui estão listados todos os pagamentos recebidos pelo sistema.</p>
        
        <div class="card shadow mb-4" style="margin-top: 1.5rem">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Pagamento</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th>Taxa</th>
                                <th>Total</th>
                                <th>Itens</th>
                                <th>Ações</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pagamentos as $pagamento)
                                <tr>
                                    <td>{{$pagamento->id}}</td>
                                    <td>{{$pagamento->created_at->format('d/m/Y')}}</td>
                                    <td class="py-1 px-2">
                                        <small class="text-white py-1 px-2 rounded {{$pagamento->isPaid() ? 'bg-success' : 'bg-secondary' }}" style="width: 100px;display: block;text-align: center;">
                                            {{$pagamento->isPaid() ? 'Pago' : 'Não Pago'}}
                                        </small
                                        >
                                    </td>
                                    <td class="py-1 px-2">
                                        {{ TaxaPagamento::getDescription($pagamento->tipo_taxa) }}
                                    </td>
                                    <td class="py-1 px-2">${{number_format($pagamento->valor, 2, ',', '.')}}</td>
                                    <td>{{$pagamento->itens()->count()}} iten(s)</td>
                                    <td>
                                        @if (!$pagamento->isPaid())
                                            <a href="<?=$pagamento->getWhatsappLinkPagamento('https://www.mercadopago.com.br/checkout/v1/redirect?pref_id='.$pagamento->session_id, false)?>" target="_blank" class="btn btn-info">
                                                Reenviar
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-solid fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route('pagamento.show', ['pagamento' => $pagamento->id])}}">Visualizar</a>
                                                <a href="{{ route('pagamento.destroy', $pagamento->id) }}" class="dropdown-item" data-confirm-delete="true">Deletar</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection