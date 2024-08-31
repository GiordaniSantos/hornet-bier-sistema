@extends('layouts.app')

@section('titulo', 'Missão Evidente - Meu Perfil')

@section('content')
<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-header">Meu Perfil</div>
        <div class="card-body">
            @component('admin.perfil._form', ['user' => $user])
            @endcomponent
        </div>
    </div>
</div>
</div>
@endsection