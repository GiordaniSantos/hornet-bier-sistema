<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrdemServico;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrdemServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = OrdemServico::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('cliente_id') && $request->cliente_id != '') {
            $query->where('cliente_id', $request->cliente_id);
        }

        $ordemServicos = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($ordemServicos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdemServico  $ordemservico
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrdemServico  $ordemservico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\OrdemServico $ordemservico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}