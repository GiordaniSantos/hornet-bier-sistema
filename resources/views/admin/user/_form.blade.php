
@if(isset($user->id))
    <form method="post" action="{{ route('usuario.update', ['usuario' => $user->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
@else
    <form method="post" action="{{ route('usuario.store') }}" enctype="multipart/form-data">
        @csrf
@endif
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label>Nome:</label>
            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus
                id="name" value="{{ isset($user) ? old('name', $user->name) : old('name') }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-sm-6">
            <label>Endereço de Email:</label>
            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" required autocomplete="email" value="{{ isset($user) ? old('email', $user->email) : old('email') }}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label>Senha:</label>
            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" autocomplete="new-password"
                id="password">
                @if(isset($user->id))
                    <div class="hint-block">Deixe em branco para manter a atual.</div>
                @endif
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-sm-6">
            <label>Confirmar Senha:</label>
            <input type="password" class="form-control form-control-user" name="password_confirmation" autocomplete="new-password"
                id="password-confirm">
        </div>
    </div>
    <button class="btn btn-primary" type="submit">{{isset($user->id) ? 'Atualizar' : 'Criar'}}</button>
</form>