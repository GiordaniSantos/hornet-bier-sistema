@extends('layouts.app')

@section('titulo', 'Missão Evidente - Dashboard')

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

    <!-- Page Heading 
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>-->

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
                <select name="mes" class="form-control">
                    <option value="1" @if(isset($_GET['mes']) && $_GET['mes'] == "1"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Janeiro" ? 'selected' : '' }}@endif> Janeiro </option>
                    <option value="2" @if(isset($_GET['mes']) && $_GET['mes'] == "2"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Fevereiro" ? 'selected' : '' }}@endif>Fevereiro</option>
                    <option value="3" @if(isset($_GET['mes']) && $_GET['mes'] == "3"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Março" ? 'selected' : '' }}@endif> Março </option>
                    <option value="4" @if(isset($_GET['mes']) && $_GET['mes'] == "4"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Abril" ? 'selected' : '' }}@endif> Abril </option>
                    <option value="5" @if(isset($_GET['mes']) && $_GET['mes'] == "5"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Maio" ? 'selected' : '' }}@endif> Maio </option>
                    <option value="6" @if(isset($_GET['mes']) && $_GET['mes'] == "6"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Junho" ? 'selected' : '' }}@endif> Junho </option>
                    <option value="7" @if(isset($_GET['mes']) && $_GET['mes'] == "7"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Julho" ? 'selected' : '' }}@endif> Julho </option>
                    <option value="8" @if(isset($_GET['mes']) && $_GET['mes'] == "8"){{"selected"}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Agosto" ? 'selected' : '' }}@endif> Agosto </option>
                    <option value="9" @if(isset($_GET['mes']) && $_GET['mes'] == "9"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Setembro" ? 'selected' : '' }}@endif> Setembro </option>
                    <option value="10" @if(isset($_GET['mes']) && $_GET['mes'] == "10"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Outubro" ? 'selected' : '' }}@endif> Outubro </option>
                    <option value="11" @if(isset($_GET['mes']) && $_GET['mes'] == "11"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Novembro" ? 'selected' : '' }}@endif> Novembro </option>
                    <option value="12" @if(isset($_GET['mes']) && $_GET['mes'] == "12"){{'selected'}} @elseif(!isset($_GET['mes'])){{ ($mes_extenso["$mes"] ?? old('mes')) == "Dezembro" ? 'selected' : '' }}@endif> Dezembro </option>
                </select>
                {{ $errors->has('mes') ? $errors->first('mes') : '' }}
                <input class="form-control" id="ano" name="ano" type="number" placeholder="" value="{{$anoInputValue}}">
                <button class="btn btn-primary" type="submit" style="margin-left: 5px;margin-right: 5px;">Filtrar</button>
                <a href="{{route('home')}}" class="btn btn-primary" type="submit">limpar</a>
            </form>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        

    </div>

    <!-- Content Row -->

    <div class="row">

    </div>
    <div class="row">

    </div>
    

    

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection
