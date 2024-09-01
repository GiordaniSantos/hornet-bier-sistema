<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=> ['required', 'email'],
            'password' => 'required',
            'remember' => 'boolean'
        ]);

        $remember = $credentials['remember'] ?? false;

        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return response([
                'message' => 'Email ou Senha incorretos'
            ], 422);
        }

        /** @var User $user */
        $user = Auth::user();

        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);

    }

    public function signUp(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email'=> ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8']
        ], [
            'required' => 'O campo :attribute deve ser preenchido',
            'email.email' => 'O campo email deve ser do tipo email.',
            'email.unique' => 'O email fornecido já está sendo utilizado, informe outro email.',
            'password.min' => 'O campo senha deve ter no minimo 8 caracteres.'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response($user, 204);
    }

    public function logout()
    {
        /** @var User $user */
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response('', 204);
    }

    public function reset(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            //'token' => 'required|string',
            //'password' => 'required|confirmed',
            //'password_confirmation' => 'required',
        ]);

        $user = User::whereEmail($validatedData['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $token = Str::random(60);

        $existingToken = \DB::table('password_reset_tokens')->whereEmail($user->email)->first();

        if ($existingToken) {
            \DB::table('password_reset_tokens')->whereEmail($user->email)->update([
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        } else {
            \DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        $user->notify(new ResetPasswordNotification($token, $user->email));

        return response()->json(['message' => 'Email de redefinição de senha enviado com sucesso']);
    }

    public function resetPassword(Request $request, $token)
    {
        $validatedData = $request->validate([
            //'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $passwordReset = \DB::table('password_reset_tokens')->whereToken($token)->first();
        
        if (!$passwordReset) {
            return response()->json(['message' => 'Token de redefinição de senha inválido'], 401);
        }

        if (Carbon::parse($passwordReset->created_at)->addMinutes(config('auth.passwords.users.expire'))->isPast()) {
            return response()->json(['message' => 'Token de redefinição de senha expirou'], 401);
        }
        
        $user = User::whereEmail($passwordReset->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $user->password = bcrypt($validatedData['password']);
        $user->save();

        \DB::table('password_reset_tokens')->whereEmail($user->email)->delete();

        return response()->json(['message' => 'Senha redefinida com sucesso']);
    }
}
