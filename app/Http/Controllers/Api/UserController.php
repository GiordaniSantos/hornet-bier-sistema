<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonListResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserController extends Controller
{
 
       /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        if($user === null){
            return response()->json(['erro' => 'Usuário não encontrado.'], 404);
        }
        return response()->json($user, 200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        if($user === null){
            return response()->json(['erro' => 'Usuário não encontrado.'], 404);
        }
        $request->validate(User::rules(), User::feedback());
        if(isset($request->password)){
            $user->password = Hash::make($request->password);
        }
        if(isset($request->email) && $request->email != $user->email){
            $user->email = $request->email;
        }
        $user->name = $request->name;
        $user->save();

        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if($user === null){
            return response()->json(['erro' => 'Usuário não existe.'], 404);
        }
        $user->delete();

        return response()->json(['msg' => 'Registro deletado com sucesso!'], 200);
    }
}