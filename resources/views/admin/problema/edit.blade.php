@extends('layouts.app')

@section('titulo', 'Hornet Bier - Editar Problema')

@section('content')
<div class="container-fluid">
    <a href="{{ route('problema.index') }}" class="btn btn-secondary btn-icon-split m-0">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Listar</span>
    </a><br><br>
    <div class="card mb-4">
        <div class="card-header">Editar Problema</div>
        <div class="card-body">
            @component('admin.problema._form', ['problema' => $problema])
            @endcomponent
        </div>
    </div>
</div>
</div>
@endsection