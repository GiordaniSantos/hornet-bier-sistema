@extends('layouts.app')

@section('titulo', 'Hornet Bier - Serviços')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Serviços</h1>
        <p class="mb-4">Aqui estão listados todos os Serviços, você pode adicionar, excluir e também realizar filtros de acordo com seu interesse.</p>

        <a href="{{ route('servico.create') }}" class="btn btn-success btn-icon-split m-0">
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
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Data de Criação</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($servicos as $servico)
                                <tr>
                                    <td>{{$servico->id}}</td>
                                    <td>{{$servico->nome}}</td>
                                    <td>{{$servico->created_at->format('d/m/Y')}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-solid fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route('servico.edit', ['servico' => $servico->id])}}">Atualizar</a>
                                                <a class="dropdown-item" href="{{route('servico.show', ['servico' => $servico->id])}}">Visualizar</a>
                                                <a href="{{ route('servico.destroy', $servico->id) }}" class="dropdown-item" data-confirm-delete="true">Deletar</a>
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