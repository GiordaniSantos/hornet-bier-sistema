
@if(isset($problema->id))
    <form method="post" action="{{ route('problema.update', ['problema' => $problema->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
@else
    <form method="post" action="{{ route('problema.store') }}" enctype="multipart/form-data">
        @csrf
@endif
    <div class="form-group row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <label>Nome:</label>
            <input type="text" class="form-control form-control-user @error('nome') is-invalid @enderror" name="nome" required autocomplete="nome" autofocus
                id="nome" value="{{ isset($problema) ? old('nome', $problema->nome) : old('nome') }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <label>Descrição:</label>
            <textarea id="descricao" name="descricao" rows="5" cols="33" class="form-control form-control-user @error('descricao') is-invalid @enderror" autocomplete="descricao" autofocus>{{ isset($problema) ? old('descricao', $problema->descricao) : old('descricao') }}</textarea>
            @error('descricao')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <button class="btn btn-primary" type="submit">{{isset($problema->id) ? 'Atualizar' : 'Adicionar'}}</button>
</form>