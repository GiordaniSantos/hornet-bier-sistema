@extends('layouts.app')

@section('titulo', 'Hornet Bier - Adicionar Serviço')

@section('content')
    <div class="container-fluid">
        <a href="{{ route('servico.index') }}" class="btn btn-secondary btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Listar</span>
        </a><br><br>
        <div class="card mb-4">
            <div class="card-header">Adicionar Serviço</div>
            <div class="card-body">
                @component('admin.servico._form')
                @endcomponent
            </div>
        </div>
    </div>
@endsection