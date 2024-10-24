<?php
use App\Enums\StatusOrdemServico;
?>

@extends('layouts.app')

@section('titulo', 'Hornet Bier - Ordens de Serviços')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Ordens de Serviços</h1>
        <p class="mb-4">Aqui estão listados todas as Ordens de Serviços, você pode adicionar, editar e também realizar filtros de acordo com seu interesse.</p>

        <a href="{{ route('ordem-servico.create') }}" class="btn btn-success btn-icon-split m-0">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Adicionar</span>
        </a><br>
        
        <form method="GET" action="{{ route('ordem-servico.index') }}">
            <div class="form-group row mt-4">
                <div class="col-12 col-lg-6 col-xl-4 mb-2">
                    <select name="status" id="status" class="form-control form-control-user">
                        <option value="">Selecione o Status</option>
                        @foreach(StatusOrdemServico::cases() as $case)
                            <option value="{{ $case->value }}" {{ request('status') == $case->value ? 'selected' : '' }}>{{ StatusOrdemServico::getDescription($case->value) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-lg-6 col-xl-4 mb-2">
                    <select name="cliente_id" class="form-control">
                        <option value="">Selecione o Cliente</option>
                        @if ($clientes)            
                            @foreach ($clientes as $cliente)
                                <option value="{{$cliente->id}}" {{ request('cliente_id') == $cliente->id ? 'selected' : '' }}>{{$cliente->nome}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-12 col-lg-12 col-xl-4">
                    <button type="submit" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <span class="text">Filtrar</span>
                    </button>
                    <a href="{{ route('ordem-servico.index') }}" type="submit" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-broom"></i>
                        </span>
                        <span class="text">Limpar Filtro</span>
                    </a>
                </div>
            </div>
        </form>
        <div class="card shadow mb-4" style="margin-top: 1.5rem">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Número OS</th>
                                <th>Cliente</th>
                                <th>Status</th>
                                <th>Data de Entrada</th>
                                <th>Data de Saída</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ordemServicos as $ordemServico)
                                <tr data-id="{{$ordemServico->id}}" data-data_entrada="{{$ordemServico->data_entrada}}" data-data_saida="{{$ordemServico->data_saida}}" data-status="{{$ordemServico->status}}">
                                    <td>{{$ordemServico->id}}</td>
                                    <td>{{$ordemServico->numero}}</td>
                                    <td>{{$ordemServico->cliente->nome}}</td>
                                    <td>{{$ordemServico->getStatusFormatado()}}</td>
                                    <td>{{ $ordemServico->data_entrada ? date('d/m/Y', strtotime(str_replace('/', '-', $ordemServico->data_entrada))) : null }}</td>
                                    <td>{{ $ordemServico->data_saida ? date('d/m/Y', strtotime(str_replace('/', '-', $ordemServico->data_saida))) : null }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-solid fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route('orcamento', ['id' => $ordemServico->id])}}" target="_blank">Gerar Orçamento</a>
                                                <a class="dropdown-item" href="{{route('orcamento-zap', ['id' => $ordemServico->id])}}" target="_blank">Enviar Orçamento por Whatsapp</a>
                                                <a class="dropdown-item" href="{{route('orcamento-email', ['id' => $ordemServico->id])}}">Enviar Orçamento por Email</a>
                                                <button class="dropdown-item" data-toggle="modal" data-target="#updateStatusModal">Alterar Status</button>
                                                <a class="dropdown-item" href="{{route('ordem-servico.edit', ['ordem_servico' => $ordemServico->id])}}">Atualizar</a>
                                                <a class="dropdown-item" href="{{route('ordem-servico.show', ['ordem_servico' => $ordemServico->id])}}">Visualizar</a>
                                                <a href="{{ route('ordem-servico.destroy', $ordemServico->id) }}" class="dropdown-item" data-confirm-delete="true">Deletar</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStatusModalLabel">Alterar Status Ordem de Serviço</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="data_saida">Status</label>
                            <select name="status" class="form-control form-control-user" id="status">
                                @foreach(StatusOrdemServico::cases() as $case)
                                    <option value="{{ $case->value }}">{{ StatusOrdemServico::getDescription($case->value) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="data_saida">Data de Entrada</label>
                            <input type="date" class="form-control" required id="data_entrada" name="data_entrada">
                        </div>
                        <div class="form-group">
                            <label for="data_saida">Data de Saída</label>
                            <input type="date" class="form-control" id="data_saida" name="data_saida">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="makePostBtn">Atualizar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var selectedId;

        $('tbody tr').on('click', function() {
            selectedId = $(this).data('id');
            var status = $(this).data('status');
            var data_entrada = $(this).data('data_entrada');
            var data_saida = $(this).data('data_saida');

            $('#updateStatusModal #status').val(status);
            $('#updateStatusModal #data_entrada').val(data_entrada);
            $('#updateStatusModal #data_saida').val(data_saida);
        });

        $('#makePostBtn').on('click', function() {
            var formData = $('#updateStatusModal form').serialize();

            $.ajax({
                type: 'POST',
                url: '{{ route('orcamento-servico.fechar', ['id' => ':id']) }}'.replace(':id', selectedId),
                data: formData,
                success: function(data) {

                    $('#updateStatusModal').hide();
                    
                    let timerInterval;
                    Swal.fire({
                    title: "Atualizando a Ordem de Serviço!",
                    html: "Aguade <b></b> milisegundos.",
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endsection