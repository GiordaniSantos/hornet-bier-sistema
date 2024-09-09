@extends('layouts.app')

@section('titulo', 'Hornet Bier - Visualizar Ordem de Serviço')

@section('content')
    <div class="container-fluid">
        <a href="{{ route('ordem-servico.index') }}" class="btn btn-secondary btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-list"></i>
            </span>
            <span class="text">Listar</span>
        </a>
        <a href="{{ route('ordem-servico.edit', ['ordem_servico' => $ordemServico->id]) }}" class="btn btn-warning btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-pen"></i>
            </span>
            <span class="text">Atualizar</span>
        </a>
        <a href="{{ route('ordem-servico.create') }}" class="btn btn-success btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Criar</span>
        </a>
        <a href="{{ route('orcamento', ['id' => $ordemServico->id]) }}" target="_blank" class="btn btn-info btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-file-pdf"></i>
            </span>
            <span class="text">Gerar Orçamento</span>
        </a>
        <a href="{{ route('orcamento-zap', ['id' => $ordemServico->id]) }}" target="_blank" class="btn btn-success btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fa-brands fa-whatsapp"></i>
            </span>
            <span class="text">Enviar Orçamento por Whatsapp</span>
        </a>
        <a href="{{ route('orcamento-email', ['id' => $ordemServico->id]) }}" class="btn btn-info btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fa-solid fa-envelope"></i>
            </span>
            <span class="text">Enviar Orçamento por Email</span>
        </a>
        <button type="button" class="btn btn-info btn-icon-split m-0" data-toggle="modal" data-target="#imagemModal">
            <span class="icon text-white-50">
                <i class="fa-solid fa-qrcode"></i>
            </span>
            <span class="text">Gerar QR</span>
        </button>
        <br><br>
        <div class="card mb-4">
            <div class="card-header">Visualizar Ordem de Serviço: {{ $ordemServico->numero }}</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>ID:</td>
                        <td>{{ $ordemServico->id }}</td>
                    </tr>
                    <tr>
                        <td>Número da OS:</td>
                        <td>{{ $ordemServico->numero }}</td>
                    </tr>
                    <tr>
                        <td>Modelo:</td>
                        <td>{{$ordemServico->modelo}}</td>
                    </tr>
                    <tr>
                        <td>Série:</td>
                        <td>{{$ordemServico->serie}}</td>
                    </tr>
                    <tr>
                        <td>Número do Motor:</td>
                        <td>{{$ordemServico->numero_motor}}</td>
                    </tr>
                    <tr>
                        <td>Cliente:</td>
                        <td>{{$ordemServico->cliente->nome}}</td>
                    </tr>
                    <tr>
                        <td>Problemas:</td>
                        <td>
                            @foreach($ordemServico->problemas as $problema)
                                {{$problema->nome}}<br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Peças Utilizadas:</td>
                        <td>
                            <?php $valorTotal = 0 ?>
                            @foreach($ordemServico->pecas as $peca)
                                <?php $valorTotal += $peca->pivot->valor_peca * $peca->pivot->quantidade?>
                                {{$peca->nome}} - R${{ number_format($peca->pivot->valor_peca, 2, ',', '.') }} x {{ $peca->pivot->quantidade }} = R${{ number_format($peca->pivot->valor_peca * $peca->pivot->quantidade, 2, ',', '.') }}<br>
                            @endforeach
                            <br>Valor Total de Peças: R${{ number_format($valorTotal, 2, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Serviços Prestados:</td>
                        <td>
                            Desmontagem<br>
                            Limpeza<br>
                            @foreach($ordemServico->servicos as $servico)
                                {{$servico->nome}}<br>
                            @endforeach
                            Ajuste da temperatura de 0 a - 1 grau
                        </td>
                    </tr>
                    <tr>
                        <td>Valor Mão de Obra:</td>
                        <td>R${{number_format($ordemServico->valor, 2, ',', '.')}}</td>
                    </tr>
                    <tr>
                        <td>Valor Total:</td>
                        <td>R${{number_format($ordemServico->valor_total, 2, ',', '.')}}</td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td>{{ $ordemServico->getStatusFormatado() }}</td>
                    </tr>
                    <tr>
                        <td>Data de Saída:</td>
                        <td>{{ $ordemServico->data_saida ? date('d/m/Y', strtotime(str_replace('/', '-', $ordemServico->data_saida))) : null }}</td>
                    </tr>
                    <tr>
                        <td>Observações:</td>
                        <td>{{ $ordemServico->observacao }}</td>
                    </tr>
                    <tr>
                        <td>Data de Criação da OS:</td>
                        <td>{{ $ordemServico->created_at->format('d/m/Y') }} às {{ $ordemServico->created_at->format('H:i') }}h</td>
                    </tr>
                    <tr>
                        <td>Data Modificação:</td>
                        <td>{{ $ordemServico->updated_at->format('d/m/Y') }} às {{ $ordemServico->updated_at->format('H:i') }}h</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="imagemModal" tabindex="-1" role="dialog" aria-labelledby="imagemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagemModalLabel">QR-CODE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ route('qr-code', ['id' => $ordemServico->id]) }}" id="imagem" alt="QR-CODE">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-secondary" onclick="imprimirImagem()">Imprimir</button>
                    <button type="button" class="btn btn-secondary" onclick="baixarImagem()">Baixar</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function imprimirImagem() {
            var imagem = document.getElementById('imagem').src;
            var win = window.open('', '_blank', 'width=500,height=500');
            win.document.write('<html><head><title>QR-CODE</title>');
            win.document.write('</head><body style="text-align: center;">');
            win.document.write('<img src="' + imagem + '" style="width: 100%; height: auto;">');
            win.document.write('</body></html>');
            
            setTimeout(function() {
                win.print();
                win.close();
            }, 2000);
        }

        function baixarImagem() {
            var imagem = document.getElementById('imagem').src;
            var link = document.createElement('a');
            link.href = imagem;
            link.download = 'qr-code.png';
            link.click();
        }
    </script>
@endsection