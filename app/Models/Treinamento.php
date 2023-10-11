<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treinamento extends Model
{
    use SoftDeletes, HasFactory;

    public $timestamps = true;

    public function cidade(){
        return $this->belongsTo(Cidades::class);
    }

    public function escola(){
        return $this->belongsTo(Escola::class);
    }

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }

    public function topicos(){
        return $this->hasMany(Topico::class);
    }
}
