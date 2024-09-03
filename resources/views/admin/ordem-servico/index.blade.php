@extends('layouts.app')

@section('titulo', 'Hornet Bier - Ordens de Serviços')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Ordens de Serviços</h1>
        <p class="mb-4">Aqui estão listados todas as Ordens de Serviços, você pode adicionar, editar e também realizar filtros de acordo com seu interesse.</p>

        <a href="{{ route('ordem-servico.create') }}" class="btn btn-success btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Adicionar</span>
        </a><br>
        
        <div class="card shadow mb-4" style="margin-top: 1.5rem">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Número OS</th>
                                <th>Cliente</th>
                                <th>Modelo</th>
                                <th>Status</th>
                                <th>Data de Entrada</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ordemServicos as $ordemServico)
                                <tr>
                                    <td>{{$ordemServico->numero}}</td>
                                    <td>{{$ordemServico->cliente->nome}}</td>
                                    <td>{{$ordemServico->modelo}}</td>
                                    <td>{{$ordemServico->getStatusFormatado()}}</td>
                                    <td>{{$ordemServico->created_at->format('d/m/Y')}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-solid fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route('orcamento', ['id' => $ordemServico->id])}}" target="_blank">Gerar Orçamento</a>
                                                <a class="dropdown-item" href="{{route('ordem-servico.edit', ['ordem_servico' => $ordemServico->id])}}">Atualizar</a>
                                                <a class="dropdown-item" href="{{route('ordem-servico.show', ['ordem_servico' => $ordemServico->id])}}">Visualizar</a>
                                                <a href="{{ route('ordem-servico.destroy', $ordemServico->id) }}" class="dropdown-item" data-confirm-delete="true">Deletar</a>
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