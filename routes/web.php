<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MarcaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\ProblemaController;
use App\Http\Controllers\PecaController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RelatorioController;

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
})->name('inicio');

Route::get('/admin', function(){
    return redirect()->route('home');
});

Auth::routes(['register' => false, 'reset' => false, 'verify' => false, 'logout' => true]);

Route::get('/orcamento-os/{id}', [PdfController::class, 'index'])->name('orcamento');

Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/failure', [CheckoutController::class, 'failure'])->name('checkout.failure');

Route::middleware(['auth'])->prefix('/admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/table', function () {
        return view('admin.table');
    })->name('table');

    //clientes
    Route::resource('/cliente', ClienteController::class);

    //problemas
    Route::resource('/problema', ProblemaController::class);

    //pecas
    Route::resource('/peca', PecaController::class);

    //marcas
    Route::resource('/marca', MarcaController::class);

    //ordem de servico
    Route::resource('/ordem-servico', OrdemServicoController::class);

    //pagamentos
    Route::resource('/pagamento', PagamentoController::class);
    Route::get('/alterar-status-pagamento/{id}', [PagamentoController::class, 'setStatusPagamento'])->name('set-status-pagamento');

    //fechar ordem de serviço
    Route::post('/fechar-ordem-servico/{id}', [OrdemServicoController::class, 'fecharOrdemServico'])->name('orcamento-servico.fechar');

    //servicos
    Route::resource('/servico', ServicoController::class);

    Route::get('/orcamento-whatsapp/{id}', [OrdemServicoController::class, 'enviarOrcamentoWhatsapp'])->name('orcamento-zap');

    Route::post('/multiplo-orcamento-whatsapp', [OrdemServicoController::class, 'enviarMultiplosOrcamentoWhatsapp'])->name('multiplo-orcamento-zap');

    Route::get('/qr-code-orcamento/{id}', [OrdemServicoController::class, 'gerarQr'])->name('qr-code');

    Route::get('/orcamento-email/{id}', [OrdemServicoController::class, 'enviarOrcamentoPorEmail'])->name('orcamento-email');

    Route::get('/link-pagamento-whatsapp/{id}', [CheckoutController::class, 'checkoutOrdemServico'])->name('link-pagamento');

    Route::post('/link-multiplo-pagamento-whatsapp', [CheckoutController::class, 'checkoutMultiploOrdemServico'])->name('multiplo-link-pagamento');

    //relatorio
    Route::get('/relatorio-os-mes', [RelatorioController::class, 'dadosOSMes']);
    Route::get('/relatorio-os-por-cliente', [RelatorioController::class, 'dadosOrdensPorCliente']);

    //usuario
    Route::resource('/usuario', UserController::class);
    Route::get('/meu-perfil', [UserController::class, 'viewPerfil'])->name('perfil.view');
    Route::put('/meu-perfil/{id}', [UserController::class, 'updatePerfil'])->name('perfil.update');

    Route::get('/configuracao', [ConfiguracaoController::class, 'edit'])->name('configuracao')->middleware('admin');
    Route::post('/configuracao', [ConfiguracaoController::class, 'update'])->name('configuracao.update')->middleware('admin');
});
