<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //SoftDeletes

    protected $table = "usuarios";

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function escolas()
    {
        return $this->belongsToMany(Escola::class, 'usuarios_escolas',
            'usuario_id', 'escola_id');
    }


    public function isSuperAdmin()
    {
        if ('ROLE_SUPERADMIN'==Auth::user()->role or
            'ROLE_ADMIN'==Auth::user()->role or
            'ROLE_USUARIO'==Auth::user()->role){
            return true;
        }else{
            return false;
        }
    }

    public function isAdmin()
    {
        if ('ROLE_ADMIN'==Auth::user()->role or
            'ROLE_USUARIO'==Auth::user()->role){
            return true;
        }else{
            return false;
        }
    }

    public function isUsuario()
    {
        if ('ROLE_USUARIO'==Auth::user()->role){
            return true;
        }else{
            return false;
        }
    }
}
