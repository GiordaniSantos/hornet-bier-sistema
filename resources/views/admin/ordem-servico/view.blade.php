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
                        <td>Serviços Prestados:</td>
                        <td><?=$ordemServico->descricao_servico?></td>
                    </tr>
                    <tr>
                        <td>Peças Utilizadas:</td>
                        <td><?=$ordemServico->pecas_utilizadas?></td>
                    </tr>
                    <tr>
                        <td>Valor:</td>
                        <td>R${{ $ordemServico->valor }}</td>
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
                        <td>Data de Criação da OS:</td>
                        <td>{{ $ordemServico->created_at->format('d/m/Y à H:i:s') }}</td>
                    </tr>
                    <tr>
                        <td>Data Modificação:</td>
                        <td>{{ $ordemServico->updated_at->format('d/m/Y à H:i:s') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection