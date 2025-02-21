@extends('layouts.app')

@section('titulo', 'Hornet Bier - Visualizar Pagamento')

@section('content')
    <div class="container-fluid">
        <a href="{{ route('pagamento.index') }}" class="btn btn-secondary btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-list"></i>
            </span>
            <span class="text">Listar</span>
        </a>
        <br><br>
        <div class="card mb-4">
            <div class="card-header">Visualizar Pagamento: {{ $pagamento->id }}</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>ID:</td>
                        <td>{{ $pagamento->id }}</td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td>   
                            <small class="text-white py-1 px-2 rounded
                                {{$pagamento->isPaid() ? 'bg-success' : 'bg-secondary' }}">
                                {{$pagamento->isPaid() ? 'Pago' : 'Não Pago'}}
                            </small>
                        </td>
                    </tr>
                    <tr>
                        <td>Itens:</td>
                        <td>   
                            @foreach($pagamento->itens as $item)
                                <a href="{{ route('ordem-servico.show', $item->ordemServico->id) }}">
                                    {{$item->ordemServico->numero}}
                                </a> -  {{$item->cliente->nome}} - R${{number_format($item->valor_item, 2, ',', '.')}}
                                <hr class="my-3"/>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Taxa:</td>
                        <td>   
                            ${{number_format($pagamento->valor_taxa, 2, ',', '.')}}
                        </td>
                    </tr>
                    <tr>
                        <td>Total:</td>
                        <td>   
                            ${{number_format($pagamento->valor, 2, ',', '.')}}
                        </td>
                    </tr>
                    <tr>
                        <td>Tipo de Pagamento:</td>
                        <td>   
                            {{$pagamento->tipo}}
                        </td>
                    </tr>
                    <tr>
                        <td>Data:</td>
                        <td>{{ $pagamento->created_at->format('d/m/Y') }} às {{ $pagamento->created_at->format('H:i') }}h</td>
                    </tr>
                    <tr>
                        <td>Data Atualização:</td>
                        <td>{{ $pagamento->updated_at->format('d/m/Y') }} às {{ $pagamento->updated_at->format('H:i') }}h</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection