<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuariosEscolas extends Model
{
    use HasFactory;

    public $timestamps = true;

    public function usuarios(){
        return $this->hasMany(Usuario::class);
    }

    public function escolas(){
        return $this->belongsToMany(Escola::class);
    }

}
