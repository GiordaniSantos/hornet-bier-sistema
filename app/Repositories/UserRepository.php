<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

abstract class UserRepository extends AbstractRepository
{
    protected static $model = User::class;

    public static function createUser(array $attributes): Model
    {
        $user = self::loadModel();
        $user->name = $attributes['name'] ?? null;
        $user->email = $attributes['email'] ?? null;

        if (isset($attributes['password'])) {
            $user->password = Hash::make($attributes['password']);
        }
        
        if (isset($attributes['email']) && $attributes['email'] !== $user->email) {
            $user->email = $attributes['email'];
        }
        
        $user->save();

        return $user;
    }

     public static function updateUser(Model $user, array $attributes): Model
    {
        $user->name = $attributes['name'] ?? null;

        if (isset($attributes['password'])) {
            $user->password = Hash::make($attributes['password']);
        }
        
        if (isset($attributes['email']) && $attributes['email'] !== $user->email) {
            $user->email = $attributes['email'];
        }
        
        $user->save();

        return $user;
    }
}