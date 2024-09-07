
@if(isset($servico->id))
    <form method="post" action="{{ route('servico.update', ['servico' => $servico->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
@else
    <form method="post" action="{{ route('servico.store') }}" enctype="multipart/form-data">
        @csrf
@endif
    <div class="form-group row">
        <div class="col-12 col-sm-12 mb-3 mb-sm-0">
            <label>Nome:</label>
            <input type="text" class="form-control form-control-user @error('nome') is-invalid @enderror" name="nome" required autocomplete="nome" maxlength="250" autofocus id="nome" value="{{ isset($servico) ? old('nome', $servico->nome) : old('nome') }}">
            @error('nome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <button class="btn btn-success" type="submit">{{isset($servico->id) ? 'Atualizar' : 'Adicionar'}}</button>
</form>