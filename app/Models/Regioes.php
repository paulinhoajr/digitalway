<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regioes extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    public function estados()
    {
        return $this->hasMany(Estados::class);
    }

}
