<?php

namespace App\Models;

use App\Models\Tenants\Usuarios;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Espera extends Model
{
    use SoftDeletes, HasFactory;

    public $timestamps = true;

    public function escola()
    {
        return $this->belongsTo(Escola::class)->withTrashed();
    }

}
