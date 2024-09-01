@extends('layouts.app')

@section('titulo', 'Hornet Bier - Editar Cliente')

@section('content')
<div class="container-fluid">
    <a href="{{ route('cliente.index') }}" class="btn btn-primary btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Listar</span>
    </a><br><br>
    <div class="card mb-4">
        <div class="card-header">Editar Cliente</div>
        <div class="card-body">
            @component('admin.cliente._form', ['cliente' => $cliente])
            @endcomponent
        </div>
    </div>
</div>
</div>
@endsection