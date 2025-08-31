<?php 
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserService extends AbstractService
{
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    public function createUser(array $attributes): Model
    {
        $user = $this->repository->loadModel();
        $user->name = $attributes['name'] ?? null;
        $user->email = $attributes['email'] ?? null;

        if (isset($attributes['password'])) {
            $user->password = Hash::make($attributes['password']);
        }
        
        if (isset($attributes['email']) && $attributes['email'] !== $user->email) {
            $user->email = $attributes['email'];
        }
        
        $this->repository->persist($user);

        return $user;
    }

    public function updateUser(Model $user, array $attributes): Model
    {
        $user->name = $attributes['name'] ?? null;

        if (isset($attributes['password'])) {
            $user->password = Hash::make($attributes['password']);
        }
        
        if (isset($attributes['email']) && $attributes['email'] !== $user->email) {
            $user->email = $attributes['email'];
        }
        
           $this->repository->persist($user);

        return $user;
    }
}