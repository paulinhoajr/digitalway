<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topico extends Model
{
    use SoftDeletes, HasFactory;

    public $timestamps = true;

    public function treinamento(){
        return $this->belongsTo(Treinamento::class);
    }

}
