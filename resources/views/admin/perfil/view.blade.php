@extends('layouts.app')

@section('titulo', 'Missão Evidente - Minha Conta')

@section('content')
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header">Minha Conta</div>
        <div class="card-body">
            @component('admin.perfil._form', ['user' => $user])
            @endcomponent
        </div>
    </div>
</div>
</div>
@endsection