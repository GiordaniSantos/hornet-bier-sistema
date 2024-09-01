@extends('layouts.app')

@section('titulo', 'Hornet Bier - Problemas')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Problemas</h1>
        <p class="mb-4">Aqui estão listados todos os problemas possíveis para a OS, você pode adicionar, excluir e também realizar filtros de acordo com seu interesse.</p>

        <a href="{{ route('problema.create') }}" class="btn btn-primary btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Criar</span>
        </a><br>
        
        <div class="card shadow mb-4" style="margin-top: 1.5rem">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>descricao</th>
                                <th>Data de Criação</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($problemas as $problema)
                                <tr>
                                    <td>{{$problema->nome}}</td>
                                    <td>{{$problema->descricao}}</td>
                                    <td>{{$problema->created_at->format('d/m/Y')}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-solid fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route('problema.edit', ['problema' => $problema->id])}}">Atualizar</a>
                                                <a class="dropdown-item" href="{{route('problema.show', ['problema' => $problema->id])}}">Visualizar</a>
                                                <a href="{{ route('problema.destroy', $problema->id) }}" class="dropdown-item" data-confirm-delete="true">Deletar</a>
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