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
        $totalValorOrdemServicos = OrdemServico::whereNot('status', StatusOrdemServico::NaoExecutado->value)->sum('valor_total');
        
        return view('home', [
            'totalOrdemServicos' => $totalOrdemServicos,
            'totalClientes' => $totalClientes,
            'totalUsers' => $totalUsers,
            'totalValorOrdemServicos' => number_format($totalValorOrdemServicos, 2, ',', '.')
        ]);
    }
}
