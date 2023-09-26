<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estados extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    public function cidades()
    {
        return $this->hasMany(Cidades::class);
    }

    public function regioes()
    {
        return $this->belongsTo(Regioes::class);
    }

}
