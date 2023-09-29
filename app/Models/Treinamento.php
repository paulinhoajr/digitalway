<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treinamento extends Model
{
    use SoftDeletes, HasFactory;

    public $timestamps = false;


}
