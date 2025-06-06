
<?php
use App\Enums\StatusOrdemServico;

$isDisabled = isset($ordemServico) && $ordemServico->status == StatusOrdemServico::Fechado->value ? 'disabled' : '';

$countOrdemPecas = 0;
if(isset($ordemServico) && $ordemServico->pecas){
    $countOrdemPecas = count($ordemServico->pecas) - 1;
}

$pecasData = [];
$valorUnitarios = [];
if ($pecas) {
    foreach ($pecas as $peca) {
        $valorUnitarios[$peca->id] = $peca->valor_unitario;
        $selected = ($ordemServico->peca_id ?? old('peca_id')) == $peca->id ? 'selected' : '';
        $pecasData[] = [
            'id' => $peca->id,
            'text' => $peca->nome ." - R$". number_format($peca->valor_unitario, 2, ',', '.'),
            'selected' => $selected,
            'valorUnitario' => $peca->valor_unitario
        ];
    }
}

$dataAtual = new DateTime();

$dataAtual->modify('+10 days');

$dataSaida = $dataAtual->format('d/m/Y');
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
        <div class="col-12 col-md-6">
            <label>Cliente:</label>
            <select name="cliente_id" class="single-cliente js-states form-control" required {{ $isDisabled }}>
                <option></option>
                @if ($clientes)
                    @foreach ($clientes as $cliente)
                        <option value="{{$cliente->id}}" {{ ($ordemServico->cliente_id ?? old('cliente_id')) == $cliente->id ? 'selected' : '' }}>{{$cliente->nome}}</option>
                    @endforeach
                @endif
            </select>
            @if (isset($ordemServico))
                <input type="hidden" name="cliente_id" value="{{$ordemServico->cliente_id}}">
            @endif
            @error('cliente_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        @if(isset($ordemServico))
            <div class="col-12 col-md-6 mb-3 mb-sm-0">
                <label>Número da OS:</label>
                <input type="text" class="form-control form-control-user" name="modelo" autocomplete="modelo" autofocus id="modelo" value="{{ isset($ordemServico) ? old('numero', $ordemServico->numero) : old('numero') }}" disabled>
            </div>
        @endif
    </div>
    <div class="form-group row">
        <div class="col-12 col-md-4">
            <label>Marca:</label>
            <select name="marca_id" class="single-marca js-states form-control" required {{ $isDisabled }}>
                <option></option>
                @if ($marcas)
                    @foreach ($marcas as $marca)
                        <option value="{{$marca->id}}" {{ ($ordemServico->marca_id ?? old('marca_id')) == $marca->id ? 'selected' : '' }}>{{$marca->nome}}</option>
                    @endforeach
                @endif
            </select>
            @error('marca_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-12 col-md-4">
            <label>Modelo:</label>
            <input type="text" class="form-control form-control-user @error('modelo') is-invalid @enderror" name="modelo" autocomplete="modelo" autofocus id="modelo" value="{{ isset($ordemServico) ? old('modelo', $ordemServico->modelo) : old('modelo') }}" {{ $isDisabled }}>
            @error('modelo')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-12 col-md-4">
            <label>Voltagem:</label>
            <select name="voltagem" class="form-control" required {{ $isDisabled }}>
                <option value="">Selecione a Voltagem</option>
                <option value="127" {{ ($ordemServico->voltagem ?? old('voltagem')) == 127 ? 'selected' : '' }}>127V</option>
                <option value="220" {{ ($ordemServico->voltagem ?? old('voltagem')) == 220 ? 'selected' : '' }}>220V</option>
            </select>
            @error('voltagem')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        @if(isset($ordemServico))
            <input type="hidden" id="idOs" name="idOs" value="{{$ordemServico->id}}">
        @endif
        <div class="col-12 col-md-6">
            <label>Série:</label>
            <input type="text" class="form-control form-control-user @error('serie') is-invalid @enderror" name="serie" autocomplete="serie" autofocus id="serie" value="{{ isset($ordemServico) ? old('serie', $ordemServico->serie) : old('serie') }}" {{ $isDisabled }}>
            @error('serie')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-12 col-md-6 mb-3 mb-sm-0">
            <label>Número do Motor:</label>
            <input type="text" class="form-control form-control-user @error('numero_motor') is-invalid @enderror" name="numero_motor" autocomplete="numero_motor" autofocus id="numero_motor" value="{{ isset($ordemServico) ? old('numero_motor', $ordemServico->numero_motor) : old('numero_motor') }}" {{ $isDisabled }}>
            @error('numero_motor')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12 col-md-6">
            <label>Problema(s) Apresentado(s):</label>
            <select name="problema_id[]" class="multiple-problem js-states form-control @error('problema_id') is-invalid @enderror" multiple required autocomplete="problema_id" autofocus id="problema_id" {{ $isDisabled }}>
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
        <div class="col-12 col-md-6">
            <label>Servico(s) Prestado(s):</label>
            <select name="servico_id[]" class="multiple-servico js-states form-control @error('servico_id') is-invalid @enderror" multiple autocomplete="servico_id" autofocus id="servico_id" {{ $isDisabled }}>
                @if ($servicos)
                    @foreach ($servicos as $servico)
                        <option value="{{$servico->id}}">{{$servico->nome}}</option>
                    @endforeach
                @endif
            </select>
            @error('servico_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered" id="table">
                <tr>
                    <th>Peça</th>
                    <th>Quantidade</th>
                    <th>Ação</th>
                </tr>
                @if(!isset($ordemServico) || isset($ordemServico) && count($ordemServico->pecas) == 0)
                    <tr>
                        <td>
                            <select name="pecas[0][peca_id]" class="single-peca js-states form-control" style="width: 100%" {{ $isDisabled }}>
                                <option></option>
                                @if ($pecas)
                                    @foreach ($pecas as $peca)
                                        <option value="{{$peca->id}}" data-valor-unitario="{{$peca->valor_unitario}}" {{ ($ordemServico->peca_id ?? old('peca_id')) == $peca->id ? 'selected' : '' }}>{{$peca->nome}} - R${{ number_format($peca->valor_unitario, 2, ',', '.') }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            <input type="text" inputmode="numeric"  pattern="^\d{1,3}(?:\.\d{3})*(?:,\d{1,2})?$" name="pecas[0][quantidade]" placeholder="Digite a quantidade" class="form-control" {{ $isDisabled }}>
                            <input type="hidden" name="pecas[0][valor_unitario]" value="">
                        </td>
                        <td>
                            <button type="button" name="add" id="add" class="btn btn-success" {{ $isDisabled }}>Adicionar</button>
                        </td>
                    </tr>
                @else
                    @foreach($ordemServico->pecas as $key=>$ordemServicoPeca)
                        <tr>
                            <td>
                                <select name="pecas[<?=$key?>][peca_id]" class="single-peca js-states form-control" style="width: 100%" {{ $isDisabled }}>
                                    <option></option>
                                    @if ($pecas)
                                        @foreach ($pecas as $peca)
                                            <option value="{{$peca->id}}" data-valor-unitario="{{$peca->valor_unitario}}" {{ $ordemServicoPeca->id == $peca->id ? 'selected' : '' }}>{{$peca->nome}} - R${{ number_format($peca->valor_unitario, 2, ',', '.') }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                            <td>
                                <input type="text" inputmode="numeric"  pattern="^\d{1,3}(?:\.\d{3})*(?:,\d{1,2})?$" name="pecas[<?=$key?>][quantidade]" placeholder="Digite a quantidade" value="{{ $ordemServicoPeca->pivot->quantidade }}" class="form-control" {{ $isDisabled }}>
                                <input type="hidden" name="pecas[<?=$key?>][valor_unitario]" value="">
                            </td>
                            <td>
                                @if($key==0)
                                    <button type="button" name="add" id="add" class="btn btn-success" {{ $isDisabled }}>Adicionar</button>
                                @else
                                    <button type="button" class="btn btn-danger remove-table-row" {{ $isDisabled }}>Remover</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12 col-md-4">
            <label>Valor Mão de Obra (R$):</label>
            <input type="text" class="form-control form-control-user @error('valor') is-invalid @enderror" id="valor" required name="valor" autocomplete="valor" value="{{ isset($ordemServico) ? old('valor', $ordemServico->valor) : old('valor') }}" {{ $isDisabled }}>
            @error('valor')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        @if(isset($ordemServico))
            <div class="col-12 col-md-6">
                <label>Valor Total (R$):</label>
                <input type="text" class="form-control form-control-user" id="valor_total" disabled required name="valor_total" autocomplete="valor_total" value="{{ isset($ordemServico) ? old('valor_total', $ordemServico->valor_total) : old('valor_total') }}">
            </div>
        @endif
        @if(!isset($ordemServico))
            <div class="col-12 col-md-4 mb-3 mb-sm-0">
                <label>Data de Entrada:</label>
                <input type="datetime-local" class="form-control" id="data_entrada" required data-required-message="Por favor, selecione uma data" name="data_entrada" value="{{ isset($ordemServico) ? old('data_entrada', $ordemServico->data_entrada) : old('data_entrada') }}">
                @error('data_entrada')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 col-md-4 mb-3 mb-sm-0">
                <label>Data de Saída/Previsão de Saída:</label>
                <input type="datetime-local" class="form-control" id="data_saida" name="data_saida" value="{{ isset($ordemServico) ? old('data_saida', $ordemServico->data_saida) : old('data_saida') }}">
                @error('data_saida')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        @endif
    </div>
    <div class="form-group row">
        @if(isset($ordemServico))
            <div class="col-md-4 mb-3 mb-sm-0">
                <label>Data de Entrada:</label>
                <input type="datetime-local" class="form-control" required data-required-message="Por favor, selecione uma data" id="data_entrada" name="data_entrada" value="{{ isset($ordemServico) ? old('data_entrada', $ordemServico->data_entrada) : old('data_entrada') }}">
                @error('data_entrada')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-4 mb-3 mb-sm-0">
                <label>Data de Saída/Previsão de Saída:</label>
                <input type="datetime-local" class="form-control" id="data_saida" name="data_saida" value="{{ isset($ordemServico) ? old('data_saida', $ordemServico->data_saida) : old('data_saida') }}">
                @error('data_saida')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-4">
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
    <div class="form-group row">
        <div class="col-sm-12 mb-3 mb-sm-0">
            <label>Observações:</label>
            <textarea id="observacao" name="observacao" {{ $isDisabled }} rows="5" cols="33" class="form-control form-control-user @error('observacao') is-invalid @enderror" autocomplete="observacao" autofocus>{{ isset($ordemServico) ? old('observacao', $ordemServico->observacao) : old('observacao') }}</textarea>
            @error('observacao')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <button class="btn btn-success" type="submit">{{isset($ordemServico->id) ? 'Atualizar' : 'Criar'}}</button>
</form>

<?php
  $defaultDateDataEntrada = isset($ordemServico) && !empty($ordemServico->data_entrada) ? date('d/m/Y H:i', strtotime(str_replace('/', '-', $ordemServico->data_entrada))) : '';
  $defaultDateDataSaida = isset($ordemServico) && !empty($ordemServico->data_saida) ? date('d/m/Y', strtotime(str_replace('/', '-', $ordemServico->data_saida))) : $dataSaida;
?>


@if (isset($ordemServico) && count($ordemServico->problemas) > 0)
    <script type="text/javascript">
        // Setar os valores selecionados no campo select
        $('#problema_id').val(@json($ordemServico->problemas->pluck('id')));
    </script>
@endif

@if (isset($ordemServico) && count($ordemServico->servicos) > 0)
    <script type="text/javascript">
        // Setar os valores selecionados no campo select
        $('#servico_id').val(@json($ordemServico->servicos->pluck('id')));
    </script>
@endif

<script type="text/javascript">
    var pecasData = <?= json_encode($pecasData); ?>;

    var i = <?= json_encode($countOrdemPecas); ?>;;
    $('#add').click(function(){
        ++i;
        $('#table').append(
            `<tr>
                <td>
                    <select name="pecas[${i}][peca_id]" class="single-peca-${i} js-states form-control" required style="width: 100%">
                        <option></option>
                    </select>
                </td>
                <td>
                    <input type="text" inputmode="numeric" pattern="^\\d{1,3}(?:\\.\\d{3})*(?:,\\d{1,2})?$" name="pecas[${i}][quantidade]" placeholder="Digite a quantidade" required class="form-control" />
                     <input type="hidden" name="pecas[${i}][valor_unitario]" value="">
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-table-row">Remover</button>
                </td>
            </tr>
            `
        )

        $('.single-peca-'+i).select2({
            placeholder: 'Selecione a peça',
            allowClear: true,
            language: 'pt-BR',
            data: pecasData,
            sorter: function(data) {
                return data.sort(function(a, b) {
                    return b.text.localeCompare(a.text);
                });
            }
        });

        $(document).on('change', '.single-peca-'+i, function() {
            var data = $(this).select2('data')[0];
            var valorUnitario = data.valorUnitario;
            $(this).closest('tr').find('input[name*="valor_unitario"]').val(valorUnitario);
        });
    })


    $(document).ready(function() {

        //adiciona onChange para todas as peças
        $('[name^="pecas["]').on('change', function() {
            if ($(this).is('select')) {
                var index = $(this).attr('name').match(/\[(\d+)\]/)[1];
                var valorUnitario = $(this).find('option:selected').data('valor-unitario');
                console.log(valorUnitario)
                $(`input[name="pecas[${index}][valor_unitario]"]`).val(valorUnitario);
            }
        });

        //seta o valorUnitario para todas as peças
        for (var j = 0; j <= i; j++) {
            var valorUnitario = $('select[name="pecas[' + j + '][peca_id]"]').find('option:selected').data('valor-unitario');
            $('input[name="pecas[' + j + '][valor_unitario]"]').val(valorUnitario);
        }

        $('.single-cliente').select2({
            placeholder: 'Selecione o cliente',
            allowClear: true,
            language: 'pt-BR'
        });

        $('.single-marca').select2({
            placeholder: 'Selecione a marca',
            allowClear: true,
            language: 'pt-BR'
        });

        $('.single-peca').select2({
            placeholder: 'Selecione a peça',
            allowClear: true,
            language: 'pt-BR',
            sorter: function(data) {
                return data.sort(function(a, b) {
                    return b.text.localeCompare(a.text);
                });
            }
        });

        $('.multiple-problem').select2({
            language: 'pt-BR',
        });

        $('.multiple-servico').select2({
            language: 'pt-BR',
        });
    });

    $('#quantidade').mask('0.000', {
        reverse: true
    });

    $('#valor').mask('#.##0,00', {
        reverse: true
    });

    $('#valor_total').mask('#.##0,00', {
        reverse: true
    });

    flatpickr("#data_entrada", {
        locale: "pt",
        dateFormat: "d/m/Y",
        allowInput: true,
        defaultDate: "<?php echo $defaultDateDataEntrada; ?>"
    });

    flatpickr("#data_saida", {
        locale: "pt",
        dateFormat: "d/m/Y",
        allowInput: true,
        defaultDate: "<?php echo $defaultDateDataSaida; ?>"
    });

    $(document).on('click', '.remove-table-row', function(){
        $(this).parents('tr').remove();
    })
</script>
