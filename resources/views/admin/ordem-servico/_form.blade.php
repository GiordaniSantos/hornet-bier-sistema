
<?php 
use App\Enums\StatusOrdemServico;
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src="https://cdn.tiny.cloud/1/tscpebe2xv4vkktpkkorh3wcc0q4xctf2b7cuihi9z6f4j9u/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/pt-BR.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>

@if(isset($ordemServico->id))
    <form method="post" action="{{ route('ordem-servico.update', ['ordem_servico' => $ordemServico->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
@else
    <form method="post" action="{{ route('ordem-servico.store') }}" enctype="multipart/form-data">
        @csrf
@endif
    <div class="form-group row">
        @if(isset($ordemServico))
            <input type="hidden" id="idOs" name="idOs" value="{{$ordemServico->id}}">
        @endif
        <div class="col-sm-6 mb-3 mb-sm-0">
            <label>Modelo:</label>
            <input type="text" class="form-control form-control-user @error('modelo') is-invalid @enderror" name="modelo" required autocomplete="modelo" autofocus
                id="modelo" value="{{ isset($ordemServico) ? old('modelo', $ordemServico->modelo) : old('modelo') }}">
            @error('modelo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-sm-6">
            <label>Série:</label>
            <input type="text" class="form-control form-control-user @error('serie') is-invalid @enderror" name="serie" required autocomplete="serie" autofocus
                id="serie" value="{{ isset($ordemServico) ? old('serie', $ordemServico->serie) : old('serie') }}">
            @error('serie')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-4">
            <label>Cliente:</label>
            <select name="cliente_id" class="single-cliente js-states form-control" required>
                <option></option>
                @if ($clientes)            
                    @foreach ($clientes as $cliente)
                        <option value="{{$cliente->id}}" {{ ($ordemServico->cliente_id ?? old('cliente_id')) == $cliente->id ? 'selected' : '' }}>{{$cliente->nome}}</option>
                    @endforeach
                @endif
            </select>
            @error('cliente_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-sm-4">
            <label>Problema(s) Apresentado(s):</label>
            <select name="problema_id[]" class="multiple-problem js-states form-control @error('problema_id') is-invalid @enderror" multiple required autocomplete="problema_id" autofocus id="problema_id" >
                @if ($problemas)            
                    @foreach ($problemas as $problema)
                        <option value="{{$problema->id}}">{{$problema->nome}}</option>
                    @endforeach
                @endif
            </select>
            @error('problema_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-sm-4">
            <label>Valor (R$):</label>
            <input type="text" class="form-control form-control-user @error('valor') is-invalid @enderror" id="valor" name="valor" autocomplete="valor" value="{{ isset($ordemServico) ? old('valor', $ordemServico->valor) : old('valor') }}">
            @error('valor')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <label>Serviços Prestados:</label>
            <textarea id="descricao_servico" name="descricao_servico" rows="5" cols="33" class="descricao_servico form-control form-control-user @error('descricao_servico') is-invalid @enderror" autocomplete="descricao_servico" autofocus>{{ isset($ordemServico) ? old('descricao_servico', $ordemServico->descricao_servico) : old('descricao') }}</textarea>
            @error('descricao')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <label>Peças Utilizadas:</label>
            <textarea id="pecas_utilizadas" name="pecas_utilizadas" rows="5" cols="33" class="pecas_utilizadas form-control form-control-user @error('pecas_utilizadas') is-invalid @enderror" autocomplete="pecas_utilizadas" autofocus>{{ isset($ordemServico) ? old('pecas_utilizadas', $ordemServico->pecas_utilizadas) : old('pecas_utilizadas') }}</textarea>
            @error('pecas_utilizadas')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        @if(isset($ordemServico))
            <div class="col-sm-4 mb-3 mb-sm-0">
                <label>Data de Entrada:</label>
                <input type="datetime-local" class="form-control" required data-required-message="Por favor, selecione uma data" id="data_entrada" name="data_entrada" value="{{ isset($ordemServico) ? old('data_entrada', $ordemServico->created_at) : old('data_entrada') }}">
                @error('data_entrada')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-sm-4 mb-3 mb-sm-0">
                <label>Data de Saída:</label>
                <input type="datetime-local" class="form-control" id="data_saida" name="data_saida" value="{{ isset($ordemServico) ? old('data_saida', $ordemServico->data_saida) : old('data_saida') }}">
                @error('data_saida')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-sm-4">
                <label>Status:</label>
                <select name="status" class="form-control form-control-user @error('status') is-invalid @enderror" id="status">
                    @foreach(StatusOrdemServico::cases() as $case)
                        <option value="{{ $case->value }}" {{ $ordemServico->status === $case->value ? 'selected' : '' }}>{{ StatusOrdemServico::getDescription($case->value) }}</option>
                    @endforeach
                </select>
                @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        @endif
    </div>
    
    <button class="btn btn-success" type="submit">{{isset($ordemServico->id) ? 'Atualizar' : 'Criar'}}</button>
</form>

<?php
  $defaultDateDataEntrada = isset($ordemServico) && !empty($ordemServico->created_at) ? date('d/m/Y H:i', strtotime(str_replace('/', '-', $ordemServico->created_at))) : '';
  $defaultDateDataSaida = isset($ordemServico) && !empty($ordemServico->data_saida) ? date('d/m/Y', strtotime(str_replace('/', '-', $ordemServico->data_saida))) : '';
?>

@if (isset($ordemServico) && count($ordemServico->problemas) > 0)
    <script type="text/javascript">
        // Setar os valores selecionados no campo select
        $('#problema_id').val(@json($ordemServico->problemas->pluck('id')));
    </script>
@endif

<script type="text/javascript">

    $(document).ready(function() {
        $('.single-cliente').select2({
            placeholder: 'Selecione o cliente',
            allowClear: true,
            language: 'pt-BR'
        });
        $('.multiple-problem').select2({
            language: 'pt-BR',
        });
    });

    $('#valor').mask('#.##0,00', {
        reverse: true
    });

    flatpickr("#data_entrada", {
        locale: "pt",
        dateFormat: "d/m/Y H:i",
        enableTime: true,
        allowInput: true,
        defaultDate: "<?php echo $defaultDateDataEntrada; ?>"
    });

    flatpickr("#data_saida", {
        locale: "pt",
        dateFormat: "d/m/Y",
        allowInput: true,
        defaultDate: "<?php echo $defaultDateDataSaida; ?>"
    });
    
    tinymce.init({
        selector:'textarea.descricao_servico',
        language: 'pt_BR',
    });

    tinymce.init({
        selector:'textarea.pecas_utilizadas',
        language: 'pt_BR',
    });
</script>