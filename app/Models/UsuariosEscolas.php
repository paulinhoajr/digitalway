<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuariosEscolas extends Model
{
    use SoftDeletes, HasFactory;

    public $timestamps = true;

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }

    public function escola(){
        return $this->belongsTo(Escola::class);
    }
}
