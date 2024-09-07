
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

@if(isset($peca->id))
    <form method="post" action="{{ route('peca.update', ['peca' => $peca->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
@else
    <form method="post" action="{{ route('peca.store') }}" enctype="multipart/form-data">
        @csrf
@endif
    <div class="form-group row">
        <div class="col-12 col-sm-6 mb-3 mb-sm-0">
            <label>Nome:</label>
            <input type="text" class="form-control form-control-user @error('nome') is-invalid @enderror" name="nome" required autocomplete="nome" maxlength="250" autofocus id="nome" value="{{ isset($peca) ? old('nome', $peca->nome) : old('nome') }}">
            @error('nome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-12 col-sm-6 mb-3 mb-sm-0">
            <label>Valor Unitário (R$):</label>
            <input type="text" class="form-control form-control-user @error('valor_unitario') is-invalid @enderror" name="valor_unitario" required autocomplete="valor_unitario" autofocus id="valor_unitario" value="{{ isset($peca) ? old('valor_unitario', $peca->valor_unitario) : old('valor_unitario') }}">
            @error('valor_unitario')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <button class="btn btn-success" type="submit">{{isset($peca->id) ? 'Atualizar' : 'Adicionar'}}</button>
</form>

<script type="text/javascript">
     $('#valor_unitario').mask('#.##0,00', {
        reverse: true
    });
</script>