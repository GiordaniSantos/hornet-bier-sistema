<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\OrdemServico;
use App\Models\User;
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
        $totalValorOrdemServicos = OrdemServico::all()->map(function ($ordemServico) {
            $valor = str_replace('.', '', $ordemServico->valor);
            $valor = str_replace(',', '.', $valor);
            return (float) $valor;
        })->sum();
        
        return view('home', [
            'totalOrdemServicos' => $totalOrdemServicos,
            'totalClientes' => $totalClientes,
            'totalUsers' => $totalUsers,
            'totalValorOrdemServicos' => number_format($totalValorOrdemServicos, 2, ',', '.')
        ]);
    }
}
