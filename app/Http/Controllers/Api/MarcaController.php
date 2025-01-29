<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $termo = $request->input('termo');

        $query = Marca::select('id', 'nome', 'created_at');

        if ($termo) {
            $query->whereRaw('LOWER(nome) LIKE ?', ['%' . strtolower($termo) . '%']);
        }

        $marcas = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($marcas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Marca::rules(), Marca::feedback());
        $marca = new Marca();
        $marcaCriado = $marca->create($request->all());

        return response()->json($marcaCriado, 201);
    }

       /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = Marca::select('id', 'nome')->where('id', $id)->first();
        return response()->json($marca, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        $request->validate(Marca::rules(), Marca::feedback());
        $marca->update($request->all());
        return response()->json($marca, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Marca $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        $marca->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}