@extends('layouts.app')

@section('titulo', 'Hornet Bier - Clientes')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Clientes</h1>
        <p class="mb-4">Aqui estão listados todos os seus Clientes, você pode adicionar, excluir e também realizar filtros de acordo com seu interesse.</p>

        <a href="{{ route('cliente.create') }}" class="btn btn-success btn-icon-split m-0">
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
                                <th>Contato</th>
                                <th>email</th>
                                <th>CPF/CNPJ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{$cliente->id}}</td>
                                    <td>{{$cliente->nome}}</td>
                                    <td>{{$cliente->nome_contato}}</td>
                                    <td>{{$cliente->email}}</td>
                                    <td style="width: 23%;">{{$cliente->cpf_cnpj}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-solid fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route('cliente.edit', ['cliente' => $cliente->id])}}">Atualizar</a>
                                                <a class="dropdown-item" href="{{route('cliente.show', ['cliente' => $cliente->id])}}">Visualizar</a>
                                                <a href="{{ route('cliente.destroy', $cliente->id) }}" class="dropdown-item" data-confirm-delete="true">Deletar</a>
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