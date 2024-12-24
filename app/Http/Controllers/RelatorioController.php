<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    
    public function dadosOrdensPorCliente(Request $request)
    {
        $ordensServico = OrdemServico::with('cliente')->whereYear('created_at', '=', $request->ano)->get();
    
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

    public function dadosOSMes(Request $request)
    {
        $janTotal = OrdemServico::whereMonth('created_at', '=', 1)->whereYear('created_at', '=', $request->ano)->count();
        $fevTotal = OrdemServico::whereMonth('created_at', '=', 2)->whereYear('created_at', '=', $request->ano)->count();
        $marTotal = OrdemServico::whereMonth('created_at', '=', 3)->whereYear('created_at', '=', $request->ano)->count();
        $abrTotal = OrdemServico::whereMonth('created_at', '=', 4)->whereYear('created_at', '=', $request->ano)->count();
        $maiTotal = OrdemServico::whereMonth('created_at', '=', 5)->whereYear('created_at', '=', $request->ano)->count();
        $junTotal = OrdemServico::whereMonth('created_at', '=', 6)->whereYear('created_at', '=', $request->ano)->count();
        $julTotal = OrdemServico::whereMonth('created_at', '=', 7)->whereYear('created_at', '=', $request->ano)->count();
        $agoTotal = OrdemServico::whereMonth('created_at', '=', 8)->whereYear('created_at', '=', $request->ano)->count();
        $setTotal = OrdemServico::whereMonth('created_at', '=', 9)->whereYear('created_at', '=', $request->ano)->count();
        $outTotal = OrdemServico::whereMonth('created_at', '=', 10)->whereYear('created_at', '=', $request->ano)->count();
        $novTotal = OrdemServico::whereMonth('created_at', '=', 11)->whereYear('created_at', '=', $request->ano)->count();
        $dezTotal = OrdemServico::whereMonth('created_at', '=', 12)->whereYear('created_at', '=', $request->ano)->count();
        
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
