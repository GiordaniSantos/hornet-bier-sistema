
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

@if(isset($cliente->id))
    <form method="post" action="{{ route('cliente.update', ['cliente' => $cliente->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
@else
    <form method="post" action="{{ route('cliente.store') }}" enctype="multipart/form-data">
        @csrf
@endif
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label>Nome:</label>
            <input type="text" class="form-control form-control-user @error('nome') is-invalid @enderror" name="nome" required autocomplete="nome" autofocus
                id="nome" value="{{ isset($cliente) ? old('nome', $cliente->nome) : old('nome') }}">
            @error('nome')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-sm-6">
            <label>Endereço de Email:</label>
            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email" required autocomplete="email" value="{{ isset($cliente) ? old('email', $cliente->email) : old('email') }}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label>CPF/CNPJ:</label>
            <input type="text" class="form-control form-control-user @error('cpf_cnpj') is-invalid @enderror" name="cpf_cnpj" required autocomplete="cpf_cnpj" autofocus
                id="cpf_cnpj" value="{{ isset($cliente) ? old('cpf_cnpj', $cliente->cpf_cnpj) : old('cpf_cnpj') }}">
            @error('cpf_cnpj')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label>Cidade:</label>
            <input type="text" class="form-control form-control-user @error('cidade') is-invalid @enderror" name="cidade" autocomplete="cidade" autofocus
                id="cidade" value="{{ isset($cliente) ? old('cidade', $cliente->cidade) : old('cidade')}}">
            @error('cidade')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-6">
            <label>Celular:</label>
            <input type="text" class="form-control form-control-user @error('celular') is-invalid @enderror" id="celular" name="celular" autocomplete="celular" value="{{ isset($cliente) ? old('celular', $cliente->celular) : old('celular') }}">
            @error('celular')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-sm-6">
            <label>Telefone:</label>
            <input type="text" class="form-control form-control-user @error('telefone') is-invalid @enderror" id="telefone" name="telefone" autocomplete="telefone" value="{{ isset($cliente) ? old('telefone', $cliente->telefone) : old('telefone') }}">
            @error('telefone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <button class="btn btn-success" type="submit">{{isset($cliente->id) ? 'Atualizar' : 'Adicionar'}}</button>
</form>

<script type="text/javascript">
    $("#celular").mask("(00) 00000-0000");
    $("#telefone").mask("(00) 0000-0000");
  
    var options = {
        onKeyPress: function (cpf, ev, el, op) {
            var masks = ['000.000.000-000', '00.000.000/0000-00'];
            $('#cpf_cnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
        }
    }

    $('#cpf_cnpj').length > 11 ? $('#cpf_cnpj').mask('00.000.000/0000-00', options) : $('#cpf_cnpj').mask('000.000.000-00#', options);
</script>