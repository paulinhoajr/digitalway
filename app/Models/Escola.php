<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Escola extends Model
{
    use SoftDeletes, HasFactory;

    public $timestamps = true;

    public function cidade(){
        return $this->belongsTo(Cidades::class);
    }
}
