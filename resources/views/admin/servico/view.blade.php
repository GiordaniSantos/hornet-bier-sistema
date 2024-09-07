@extends('layouts.app')

@section('titulo', 'Hornet Bier - Visualizar Serviço')

@section('content')
    <div class="container-fluid">
        <a href="{{ route('servico.index') }}" class="btn btn-secondary btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-list"></i>
            </span>
            <span class="text">Listar</span>
        </a>
        <a href="{{ route('servico.edit', ['servico' => $servico->id]) }}" class="btn btn-warning btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-pen"></i>
            </span>
            <span class="text">Atualizar</span>
        </a>
        <a href="{{ route('servico.create') }}" class="btn btn-success btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Adicionar</span>
        </a>
        <br><br>
        <div class="card mb-4">
            <div class="card-header">Visualizar Serviço: {{ $servico->nome }}</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>ID:</td>
                        <td>{{ $servico->id }}</td>
                    </tr>
                    <tr>
                        <td>Nome:</td>
                        <td>{{ $servico->nome }}</td>
                    </tr>
                    <tr>
                        <td>Data Criação:</td>
                        <td>{{ $servico->created_at->format('d/m/Y') }} às {{ $servico->created_at->format('H:i') }}h</td>
                    </tr>
                    <tr>
                        <td>Data Modificação:</td>
                        <td>{{ $servico->updated_at->format('d/m/Y') }} às {{ $servico->updated_at->format('H:i') }}h</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection