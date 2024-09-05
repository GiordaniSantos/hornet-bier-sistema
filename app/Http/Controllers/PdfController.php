<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\OrdemServico;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{

    public function index($id)
    {
        $ordemServico = OrdemServico::where(['id' => $id])->first();

        if(!$ordemServico){
            alert()->error('Erro','Ordem de Serviço não encontrada.');
            return redirect()->route('inicio');
        }
        $html = view('pdf.index', ['ordemServico' => $ordemServico])->render();
        $pdf =  Pdf::loadHTML($html)->setPaper('a4', 'landscape')->setOption('isRemoteEnabled', true);
        return $pdf->stream();
    }
}
