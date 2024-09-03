<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProblemaController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\PdfController;
use App\Models\OrdemServico;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function(){
    return redirect()->route('home');
});

Auth::routes();

Route::get('/orcamento-os/{id}', [PdfController::class, 'index'])->name('orcamento');

Route::middleware(['auth'])->prefix('/admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/table', function () {
        return view('admin.table');
    })->name('table');

    //clientes
    Route::resource('/cliente', ClienteController::class);

    //problemas
    Route::resource('/problema', ProblemaController::class);

    //problemas
    Route::resource('/ordem-servico', OrdemServicoController::class);

    Route::get('/orcamento-whatsapp/{id}', [OrdemServicoController::class, 'enviarOrcamentoWhatsapp'])->name('orcamento-zap');

    //usuario
    Route::resource('/usuario', UserController::class);
    Route::get('/meu-perfil', [UserController::class, 'viewPerfil'])->name('perfil.view');
    Route::put('/meu-perfil/{id}', [UserController::class, 'updatePerfil'])->name('perfil.update');
});