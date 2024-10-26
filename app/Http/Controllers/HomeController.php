<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\OrdemServico;
use App\Models\User;
use App\Enums\StatusOrdemServico;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $totalOrdemServicos = OrdemServico::all()->count();
        $totalClientes = Cliente::all()->count();
        $totalUsers = User::all()->count();
        $totalValorOrdemServicos = OrdemServico::where('status', StatusOrdemServico::Fechado->value)->sum('valor_total');
        $totalValorMaoDeObra = OrdemServico::where('status', StatusOrdemServico::Fechado->value)->sum('valor');
        $totalValorPecas = $totalValorOrdemServicos - $totalValorMaoDeObra;
        /*$totalValorPecas = OrdemServico::where('status', StatusOrdemServico::Fechado->value)
        ->with('pecas')
        ->get()
        ->sum(function ($ordemServico) {
            $valorTotal = 0;
            foreach($ordemServico->pecas as $peca){
                $valorTotal += $peca->pivot->valor_peca * $peca->pivot->quantidade;
            }
           return $valorTotal;
        });*/
        
        return view('home', [
            'totalOrdemServicos' => $totalOrdemServicos,
            'totalClientes' => $totalClientes,
            'totalUsers' => $totalUsers,
            'totalValorOrdemServicos' => number_format($totalValorOrdemServicos, 2, ',', '.'),
            'totalValorMaoDeObra' => number_format($totalValorMaoDeObra, 2, ',', '.'),
            'totalValorPecas' => number_format($totalValorPecas, 2, ',', '.'),
        ]);
    }
}
