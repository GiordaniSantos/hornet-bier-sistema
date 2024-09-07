@extends('layouts.app')

@section('titulo', 'Hornet Bier - Visualizar Peça')

@section('content')
    <div class="container-fluid">
        <a href="{{ route('peca.index') }}" class="btn btn-secondary btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-list"></i>
            </span>
            <span class="text">Listar</span>
        </a>
        <a href="{{ route('peca.edit', ['peca' => $peca->id]) }}" class="btn btn-warning btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-pen"></i>
            </span>
            <span class="text">Atualizar</span>
        </a>
        <a href="{{ route('peca.create') }}" class="btn btn-success btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Adicionar</span>
        </a>
        <br><br>
        <div class="card mb-4">
            <div class="card-header">Visualizar Peca: {{ $peca->nome }}</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>ID:</td>
                        <td>{{ $peca->id }}</td>
                    </tr>
                    <tr>
                        <td>Nome:</td>
                        <td>{{ $peca->nome }}</td>
                    </tr>
                    <tr>
                        <td>Valor Unitário:</td>
                        <td>R${{number_format($peca->valor_unitario, 2, ',', '.')}}</td>
                    </tr>
                    <tr>
                        <td>Data Criação:</td>
                        <td>{{ $peca->created_at->format('d/m/Y') }} às {{ $peca->created_at->format('H:i') }}h</td>
                    </tr>
                    <tr>
                        <td>Data Modificação:</td>
                        <td>{{ $peca->updated_at->format('d/m/Y') }} às {{ $peca->updated_at->format('H:i') }}h</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection