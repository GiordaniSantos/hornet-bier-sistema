@extends('layouts.app')

@section('titulo', 'Hornet Bier - Visualizar Cliente')

@section('content')
<div class="container-fluid">
    <a href="{{ route('cliente.index') }}" class="btn btn-secondary btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fas fa-list"></i>
        </span>
        <span class="text">Listar</span>
    </a>
    <a href="{{ route('cliente.edit', ['cliente' => $cliente->id]) }}" class="btn btn-warning btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fas fa-pen"></i>
        </span>
        <span class="text">Atualizar</span>
    </a>
    <a href="{{ route('cliente.create') }}" class="btn btn-success btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Adicionar</span>
    </a>
    <br><br>
    <div class="card mb-4">
        <div class="card-header">Visualizar Cliente: {{ $cliente->nome }}</div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <tr>
                    <td>ID:</td>
                    <td>{{ $cliente->id }}</td>
                </tr>
                <tr>
                    <td>Nome:</td>
                    <td>{{ $cliente->nome }}</td>
                </tr>
                <tr>
                    <td>E-mail:</td>
                    <td>{{$cliente->email}}</td>
                </tr>
                <tr>
                    <td>CPF/CNPJ:</td>
                    <td>{{$cliente->cpf_cnpj}}</td>
                </tr>
                <tr>
                    <td>Cidade:</td>
                    <td>{{$cliente->cidade}}</td>
                </tr>
                <tr>
                    <td>Celular:</td>
                    <td>{{$cliente->celular}}</td>
                </tr>
                <tr>
                    <td>Telefone:</td>
                    <td>{{$cliente->telefone}}</td>
                </tr>
                <tr>
                    <td>Data Criação:</td>
                    <td>{{ $cliente->created_at->format('d/m/Y à H:i:s') }}</td>
                </tr>
                <tr>
                    <td>Data Modificação:</td>
                    <td>{{ $cliente->updated_at->format('d/m/Y à H:i:s') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
@endsection