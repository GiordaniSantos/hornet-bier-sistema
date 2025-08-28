<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
  
    public function index()
    {
        $usuarios = UserRepository::all('created_at', 'desc');

        confirmDelete('Deletar usuário administrativo!', "Você tem certeza que quer deletar este registro?");
        return view('admin.user.index', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $request)
    {
        $userCriado = UserRepository::createUser($request->all());
        
        if($userCriado){
            alert()->success('Concluído','Conta administrativa adicionada com sucesso.');
        }
        
        return redirect()->route('usuario.index');
    }

    public function edit(User $usuario)
    {
        return view('admin.user.edit', ['user' => $usuario]);
    }

    public function update(UserRequest $request, $id)
    {
        $user = UserRepository::find($id);
        if(!$user){
            abort(404, 'Usuário não encotrado!');
        }

        $user = UserRepository::updateUser($user, $request->all());
       
        if($user){
            alert()->success('Concluído','Conta administrativa atualizada com sucesso.');
        }
        
        return redirect()->route('usuario.index');
    }

    public function destroy(User $usuario)
    { 
        UserRepository::delete($usuario);
  
        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('usuario.index');
    }

    public function viewPerfil()
    {
        $user = UserRepository::find(\Auth::user()->id);

        return view('admin.perfil.view', ['user' => $user]);
    }

    public function updatePerfil(UserRequest $request, $id)
    {
        $user = UserRepository::find(\Auth::user()->id);
        if(!$user){
            abort(404, 'Usuário não encotrado!');
        }
        
        $user = UserRepository::updateUser($user, $request->all());
       
        if($user){
            alert()->success('Concluído','Conta administrativa atualizada com sucesso.');
        }
        
        return redirect()->route('perfil.view');
    }
}
