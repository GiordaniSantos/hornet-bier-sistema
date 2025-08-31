<?php

namespace App\Http\Controllers;

use App\Services\ConfiguracaoService;
use Illuminate\Http\Request;

class ConfiguracaoController extends Controller
{
    protected ConfiguracaoService $configuracaoService;

    public function __construct(ConfiguracaoService $configuracaoService)
    {
        $this->configuracaoService = $configuracaoService;
    }
    /**
     * Display a listing of the resource.
     */
    public function edit()
    {
        return view('admin.configuracao.edit');
    }

    public function update(Request $request)
    {
        $this->configuracaoService->updateDotenv($request->all());

        alert()->success('Concluído','Configurações alteradas com sucesso.');
        return redirect()->route('home');
    }
}
