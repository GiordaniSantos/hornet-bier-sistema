<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;

class RelatorioController extends Controller
{
    
    public function dadosOrdensPorCliente()
    {
        $ordensServico = OrdemServico::with('cliente')->get();
    
        $dados = $ordensServico->groupBy('cliente_id')->map(function ($ordens) {
                    return [
                        'cliente' => $ordens->first()->cliente->nome,
                        'quantidade' => $ordens->count()
                    ];
                })->values()->all();
    
        $labels = array_column($dados, 'cliente');
        $quantidades = array_column($dados, 'quantidade');
        $dados = [$labels, $quantidades];
        return response()->json(['labels' => $labels, 'quantidades' => $quantidades], 200);
    }

    public function dadosOSMes()
    {
        $janTotal = OrdemServico::whereMonth('created_at', '=', 1)->whereYear('created_at', '=', date('Y'))->count();
        $fevTotal = OrdemServico::whereMonth('created_at', '=', 2)->whereYear('created_at', '=', date('Y'))->count();
        $marTotal = OrdemServico::whereMonth('created_at', '=', 3)->whereYear('created_at', '=', date('Y'))->count();;
        $abrTotal = OrdemServico::whereMonth('created_at', '=', 4)->whereYear('created_at', '=', date('Y'))->count();
        $maiTotal = OrdemServico::whereMonth('created_at', '=', 5)->whereYear('created_at', '=', date('Y'))->count();
        $junTotal = OrdemServico::whereMonth('created_at', '=', 6)->whereYear('created_at', '=', date('Y'))->count();
        $julTotal = OrdemServico::whereMonth('created_at', '=', 7)->whereYear('created_at', '=', date('Y'))->count();
        $agoTotal = OrdemServico::whereMonth('created_at', '=', 8)->whereYear('created_at', '=', date('Y'))->count();
        $setTotal = OrdemServico::whereMonth('created_at', '=', 9)->whereYear('created_at', '=', date('Y'))->count();
        $outTotal = OrdemServico::whereMonth('created_at', '=', 10)->whereYear('created_at', '=', date('Y'))->count();
        $novTotal = OrdemServico::whereMonth('created_at', '=', 11)->whereYear('created_at', '=', date('Y'))->count();
        $dezTotal = OrdemServico::whereMonth('created_at', '=', 12)->whereYear('created_at', '=', date('Y'))->count();
        
        $dados = [
            $janTotal,
            $fevTotal,
            $marTotal,
            $abrTotal,
            $maiTotal,
            $junTotal,
            $julTotal,
            $agoTotal,
            $setTotal,
            $outTotal,
            $novTotal,
            $dezTotal
        ];
        
        return response()->json($dados, 200);
    }

}
