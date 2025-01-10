<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\OrdemServicoController;
use App\Http\Controllers\Api\ProblemaController;
use App\Http\Controllers\Api\ServicoController;
use App\Http\Controllers\Api\MarcaController;
use App\Http\Controllers\Api\PecaController;
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

    Route::apiResource('problema', ProblemaController::class);

    Route::apiResource('servico', ServicoController::class);

    Route::apiResource('marca', MarcaController::class);

    Route::apiResource('peca', PecaController::class);

    Route::apiResource('cliente', ClienteController::class);

    Route::get('relatorio', [HomeController::class, 'index']);
});

Route::post('login', [AuthController::class, 'login']);