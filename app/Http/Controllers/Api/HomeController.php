<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusOrdemServico;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\OrdemServico;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ano = $request->has('ano') ? $request->ano : date('Y');

        $totalOrdemServicos = OrdemServico::whereYear('created_at', '=', $ano)->count();
        $totalClientes = Cliente::count();
        $totalUsers = User::count();
        $totalValorOrdemServicos = OrdemServico::where('status', StatusOrdemServico::Fechado->value)->whereYear('created_at', '=', $ano)->sum('valor_total');
        $totalValorMaoDeObra = OrdemServico::where('status', StatusOrdemServico::Fechado->value)->whereYear('created_at', '=', $ano)->sum('valor');
        $totalValorPecas = $totalValorOrdemServicos - $totalValorMaoDeObra;

        return response()->json([
            'totalOrdemServicos' => $totalOrdemServicos,
            'totalClientes' => $totalClientes,
            'totalUsers' => $totalUsers,
            'totalValorOrdemServicos' => number_format($totalValorOrdemServicos, 2, ',', '.'),
            'totalValorMaoDeObra' => number_format($totalValorMaoDeObra, 2, ',', '.'),
            'totalValorPecas' => number_format($totalValorPecas, 2, ',', '.'),
        ]);
    }
}