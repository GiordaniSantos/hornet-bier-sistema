@extends('layouts.app')

@section('titulo', 'Hornet Bier - Editar Ordem de Serviço')

@section('content')
    <div class="container-fluid">
        <a href="{{ route('ordem-servico.index') }}" class="btn btn-secondary btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Listar</span>
        </a>
        <a href="{{ route('ordem-servico.show', ['ordem_servico' => $ordemServico->id]) }}" class="btn btn-warning btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-eye"></i>
            </span>
            <span class="text">Visualizar</span>
        </a><br><br>
        <div class="card mb-4">
            <div class="card-header">Editar Ordem de Serviço</div>
            <div class="card-body">
                @component('admin.ordem-servico._form', ['ordemServico' => $ordemServico, 'clientes' => $clientes, 'problemas' => $problemas, 'pecas' => $pecas, 'servicos' => $servicos, 'marcas' => $marcas])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
