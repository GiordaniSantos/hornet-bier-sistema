<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Validation\Rule;
use Spatie\Activitylog\Contracts\Activity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tapActivity(Activity $activity)
    {
        $activity->properties = $activity->properties->merge([
            'ip' => $_SERVER['REMOTE_ADDR'],
        ]);
    }

    public static function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore(auth()->id())],
            'password' => ['string', 'nullable', 'min:8', 'confirmed'],
        ];
    }

    public static function feedback(): array
    {
        return [
            //'required' => 'O campo :attribute deve ser preenchido',
            'name.max' => 'O campo nome não pode ultrapassar 255 caracteres.',
            'email.max' => 'O campo email não pode ultrapassar 255 caracteres.',
            'email.email' => 'O campo email deve ser do tipo Email.',
            'password.min' => 'O campo senha deve ter no minimo 8 caracteres.',
            'password.confirmed' => 'O campo senha não corresponde ao campo de confirmação de senha.',
        ];
    }
}
