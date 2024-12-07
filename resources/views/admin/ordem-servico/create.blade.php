@extends('layouts.app')

@section('titulo', 'Hornet Bier - Criar Ordem de Serviço')

@section('content')
    <div class="container-fluid">
        <a href="{{ route('ordem-servico.index') }}" class="btn btn-secondary btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Listar</span>
        </a><br><br>
        <div class="card mb-4">
            <div class="card-header">Criar Ordem de Serviço</div>
            <div class="card-body">
                @component('admin.ordem-servico._form', ['clientes' => $clientes, 'problemas' => $problemas, 'pecas' => $pecas, 'servicos' => $servicos, 'marcas' => $marcas])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
