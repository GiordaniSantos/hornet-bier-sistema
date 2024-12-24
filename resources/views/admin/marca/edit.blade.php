@extends('layouts.app')

@section('titulo', 'Hornet Bier - Editar Marca')

@section('content')
    <div class="container-fluid">
        <a href="{{ route('marca.index') }}" class="btn btn-secondary btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
            <span class="text">Listar</span>
        </a><br><br>
        <div class="card mb-4">
            <div class="card-header">Editar Marca</div>
            <div class="card-body">
                @component('admin.marca._form', ['marca' => $marca])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
