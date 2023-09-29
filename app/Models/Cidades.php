<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cidades extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    public function estado()
    {
        return $this->belongsTo(Estados::class);
    }
}
