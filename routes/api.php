<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\OrdemServicoController;
use App\Http\Controllers\Api\ProblemaController;
use App\Http\Controllers\Api\ServicoController;
use App\Http\Controllers\Api\MarcaController;
use App\Http\Controllers\Api\PecaController;
use App\Http\Controllers\Api\PagamentoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('ordem-servico', OrdemServicoController::class);

    Route::get('ordem-servico/view/{id}', [OrdemServicoController::class, 'view']);

    Route::get('ordem-servico-recursos', [OrdemServicoController::class, 'recursos']);

    Route::get('ordem-servico-recursos-filtro', [OrdemServicoController::class, 'recursosFiltros']);

    Route::get('ordem-servico/get-url-orcamento-whatsapp/{id}', [OrdemServicoController::class, 'getUrlOrcamentoWhatsapp']);

    Route::post('ordem-servico/get-url-multiplo-orcamento-whatsapp', [OrdemServicoController::class, 'getUrlMultiplosOrcamentoWhatsapp']);

    Route::apiResource('problema', ProblemaController::class);

    Route::apiResource('servico', ServicoController::class);

    Route::apiResource('marca', MarcaController::class);

    Route::apiResource('peca', PecaController::class);

    Route::apiResource('cliente', ClienteController::class);

    Route::apiResource('pagamento', PagamentoController::class);

    Route::get('set-status-pagamento/{id}', [PagamentoController::class, 'setStatusPagamento'])->name('set-status-pagamento');

    Route::get('select-clientes', [ClienteController::class, 'selectClientes']);

    Route::get('relatorio', [HomeController::class, 'index']);
});

Route::post('login', [AuthController::class, 'login']);