@extends('layouts.app')

@section('titulo', 'Hornet Bier - Visualizar Marca')

@section('content')
    <div class="container-fluid">
        <a href="{{ route('marca.index') }}" class="btn btn-secondary btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fas fa-list"></i>
        </span>
            <span class="text">Listar</span>
        </a>
        <a href="{{ route('marca.edit', ['marca' => $marca->id]) }}" class="btn btn-warning btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fas fa-pen"></i>
        </span>
            <span class="text">Atualizar</span>
        </a>
        <a href="{{ route('marca.create') }}" class="btn btn-success btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
            <span class="text">Adicionar</span>
        </a>
        <br><br>
        <div class="card mb-4">
            <div class="card-header">Visualizar Marca: {{ $marca->nome }}</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>ID:</td>
                        <td>{{ $marca->id }}</td>
                    </tr>
                    <tr>
                        <td>Nome:</td>
                        <td>{{ $marca->nome }}</td>
                    </tr>
                    <tr>
                        <td>Data Criação:</td>
                        <td>{{ $marca->created_at->format('d/m/Y à H:i:s') }}</td>
                    </tr>
                    <tr>
                        <td>Data Modificação:</td>
                        <td>{{ $marca->updated_at->format('d/m/Y à H:i:s') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
