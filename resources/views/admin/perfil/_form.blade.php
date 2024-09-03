<form method="post" action="{{ route('perfil.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group row" style="justify-content: center;">

        <img class="rounded-circle" width="15%" src="/images/nova-logo.png" style="margin-top: 15px; margin-bottom:25px;">
   
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus
                id="name" placeholder="Nome" value="{{ isset($user) ? old('name', $user->name) : old('name') }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-sm-6">
            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" required autocomplete="email"
                placeholder="Endereço de Email" value="{{ isset($user) ? old('email', $user->email) : old('email') }}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" autocomplete="new-password"
                id="password" placeholder="Senha">
                <div class="hint-block">Deixe em branco para manter a atual.</div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-sm-6">
            <input type="password" class="form-control form-control-user" name="password_confirmation" autocomplete="new-password"
                id="password-confirm" placeholder="Confirmar Senha">
        </div>
    </div>
    <button class="btn btn-success" type="submit">Atualizar</button>
</form>