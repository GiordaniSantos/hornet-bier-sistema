<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
  
    public function index()
    {
        $usuarios = User::orderBy('created_at', 'desc')->get();

        confirmDelete('Deletar usuário administrativo!', "Você tem certeza que quer deletar este registro?");
        return view('admin.user.index', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate(User::rules(), User::feedback());
        $user = new User();
        $user->name = $request->name;
        if(isset($request->password)){
            $user->password = Hash::make($request->password);
        }
        if(isset($request->email) && $request->email != $user->email){
            $user->email = $request->email;
        }
        if($user->save()){
            alert()->success('Concluído','Conta administrativa adicionada com sucesso.');
        }
        
        return redirect()->route('usuario.index');
    }

    public function edit(User $usuario)
    {
        return view('admin.user.edit', ['user' => $usuario]);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        if(!$user){
            abort(404, 'Usuário não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){
           
            //validacao
            $request->validate(User::rules(), User::feedback());
            if(isset($request->password)){
                $user->password = Hash::make($request->password);
            }
            if(isset($request->email) && $request->email != $user->email){
                $user->email = $request->email;
            }
            $user->name = $request->name;
            if($user->save()){
                alert()->success('Concluído','Conta administrativa atualizada com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do Conta administrativa.');
            }
        }
        
        return redirect()->route('usuario.index');
    }

    public function destroy(User $usuario)
    { 
        $usuario->delete();
  
        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('usuario.index');
    }

    public function viewPerfil()
    {
        $user = User::where('id', \Auth::user()->id)->first();

        return view('admin.perfil.view', ['user' => $user]);
    }

    public function updatePerfil(Request $request, $id)
    {
        $user = User::where('id', \Auth::user()->id)->first();
        if(!$user){
            abort(404, 'Usuário não encotrado!');
        }
        if($request->input('_token') != '' && $request->input('id') == ''){
           
            //validacao
            $request->validate(User::rules(), User::feedback());
            if(isset($request->password)){
                $user->password = Hash::make($request->password);
            }
            if(isset($request->email) && $request->email != $user->email){
                $user->email = $request->email;
            }
            $user->name = $request->name;
            if($user->save()){
                alert()->success('Concluído','Perfil atualizado com sucesso.');
            }else{
                alert()->error('ErrorAlert','Erro na atualização do Perfil.');
            }
        }
        
        return redirect()->route('perfil.view');
    }
}
