@extends('layouts.app')

@section('titulo', 'Hornet Bier - Dashboard')

@section('content')
<?php 
    $data = date('D');
    $mes = date('M');
    $dia = date('d');
    $ano = date('Y');
    
    $semana = array(
        'Sun' => 'Domingo', 
        'Mon' => 'Segunda-Feira',
        'Tue' => 'Terca-Feira',
        'Wed' => 'Quarta-Feira',
        'Thu' => 'Quinta-Feira',
        'Fri' => 'Sexta-Feira',
        'Sat' => 'Sábado'
    );
    
    $mes_extenso = array(
        'Jan' => 'Janeiro',
        'Feb' => 'Fevereiro',
        'Mar' => 'Marco',
        'Apr' => 'Abril',
        'May' => 'Maio',
        'Jun' => 'Junho',
        'Jul' => 'Julho',
        'Aug' => 'Agosto',
        'Nov' => 'Novembro',
        'Sep' => 'Setembro',
        'Oct' => 'Outubro',
        'Dec' => 'Dezembro'
    );
    $anoInputValue = isset($_GET['ano']) ? $_GET['ano'] : $ano;
    //dd(substr($_SERVER["REQUEST_URI"], 11));
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
        <div class="me-4 mb-3 mb-sm-0">
            <h1 class="mb-0">Início</h1>
            <div class="small">
                <span class="fw-500 text-primary">{{$semana["$data"]}}</span>
                · {{$dia}} de {{$mes_extenso["$mes"]}}, {{$ano}} <!-- · 12:16 PM-->
            </div>
        </div>
        <div style="display:flex;">
            <form method="get" action="{{ route('home') }}" enctype="multipart/form-data" style="display:flex;">
                @csrf
                <input class="form-control" id="ano" name="ano" type="number" placeholder="" value="{{$anoInputValue}}">
                <button class="btn btn-primary" type="submit" style="margin-left: 5px;margin-right: 5px;">Filtrar</button>
                <a href="{{route('home')}}" class="btn btn-primary" type="submit">limpar</a>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="javascript:;" id="toggleButton">
                <i class="fa-solid fa-eye fa-2x text-gray-900"></i>
            </a>
        </div>
    </div>
    <br>
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card  border-left-success shadow h-100 py-2" style="border-left: 0.25rem solid #000000!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="color: #000000 !important">
                                Total de Ordens de Serviços</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{isset($totalOrdemServicos) ? $totalOrdemServicos : '0'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-gear fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2" style="border-left: 0.25rem solid #000000!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="color: #000000 !important">
                                Total de Clientes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{isset($totalClientes) ? $totalClientes : '0'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid #000000!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="color: #000000 !important">
                                Usuários Administrativos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{isset($totalUsers) ? $totalUsers : '0'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid #000000!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="color: #000000 !important">
                                Faturamento Bruto</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 hidden-value" id="valorBruto">
                                R$.........
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-money-bill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid #000000!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="color: #000000 !important">
                                Faturamento por Mão de Obra</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 hidden-value" id="valorMaoDeObra">
                                R$.........
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-wallet fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2" style="border-left: 0.25rem solid #000000!important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="color: #000000 !important">
                                Custo com Peças</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800 hidden-value" id="valorPecas">
                                R$.........
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-cash-register fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Content Row -->
     <div class="row">
        <div class="col-xl-8 col-lg-7">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black">Quantidade de Ordens de Serviços por Mês em {{ date('Y') }}</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div><br>
                </div>
            </div>

        </div>

        <!-- Visitação -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-black">Ordens de Serviço/Cliente</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="graficoOrdemServicoPorCliente"></canvas>
                    </div><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script>
    $(document).ready(function() {
        const valorBruto = "{{ isset($totalValorOrdemServicos) ? $totalValorOrdemServicos : '0' }}";
        const valorMaoDeObra = "{{isset($totalValorMaoDeObra) ? $totalValorMaoDeObra : '0'}}";
        const valorPecas = "{{isset($totalValorPecas) ? $totalValorPecas : '0'}}";
        
        $('#toggleButton').on('click', function() {
            const senhaCorreta = "{{ env('SENHA_VALORES_TELA_INICIAL') }}";
            const senhaUsuario = prompt("Por favor, insira a senha:");

            if (senhaUsuario === senhaCorreta) {
                if ($('#valorBruto').hasClass('hidden-value')) {
                    $('#valorBruto').removeClass('hidden-value').addClass('visible').text('R$' + valorBruto);
                    $('#valorMaoDeObra').removeClass('hidden-value').addClass('visible').text('R$' + valorMaoDeObra);
                    $('#valorPecas').removeClass('hidden-value').addClass('visible').text('R$' + valorPecas);
                } else {
                    $('#valorBruto').text('R$.........').removeClass('visible').addClass('hidden-value');
                    $('#valorMaoDeObra').text('R$.........').removeClass('visible').addClass('hidden-value');
                    $('#valorPecas').text('R$.........').removeClass('visible').addClass('hidden-value');
                }
            } else {
                alert("Senha incorreta. Tente novamente.");
            }
        });
    });
</script>

<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
<!-- End of Main Content -->
@endsection
