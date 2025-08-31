<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Services\PdfService;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    protected PdfService $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function index($id)
    {
        $ordemServico = $this->pdfService->find($id);

        if(!$ordemServico){
            alert()->error('Erro','Ordem de Serviço não encontrada.');
            return redirect()->route('inicio');
        }
        $html = view('pdf.index', ['ordemServico' => $ordemServico])->render();
        $pdf =  Pdf::loadHTML($html)->setPaper('a4', 'landscape')->setOption('isRemoteEnabled', true);
        return $pdf->stream();
    }
}
