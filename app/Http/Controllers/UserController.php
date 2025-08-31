<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
  
    public function index()
    {
        $usuarios = $this->userService->getAll();

        confirmDelete('Deletar usuário administrativo!', "Você tem certeza que quer deletar este registro?");
        return view('admin.user.index', ['usuarios' => $usuarios]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $request)
    {
        $userCriado = $this->userService->createUser($request->all());
        
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
        $user = $this->userService->find($id);
        if(!$user){
            abort(404, 'Usuário não encotrado!');
        }

        $user = $this->userService->updateUser($user, $request->all());
       
        if($user){
            alert()->success('Concluído','Conta administrativa atualizada com sucesso.');
        }
        
        return redirect()->route('usuario.index');
    }

    public function destroy(User $usuario)
    { 
        $this->userService->delete($usuario);
  
        alert()->success('Concluído','Registro removido com sucesso.');
        return redirect()->route('usuario.index');
    }

    public function viewPerfil()
    {
        $user = $this->userService->find(\Auth::user()->id);

        return view('admin.perfil.view', ['user' => $user]);
    }

    public function updatePerfil(UserRequest $request, $id)
    {
        $user = $this->userService->find(\Auth::user()->id);
        if(!$user){
            abort(404, 'Usuário não encotrado!');
        }
        
        $user = $this->userService->updateUser($user, $request->all());
       
        if($user){
            alert()->success('Concluído','Conta administrativa atualizada com sucesso.');
        }
        
        return redirect()->route('perfil.view');
    }
}
