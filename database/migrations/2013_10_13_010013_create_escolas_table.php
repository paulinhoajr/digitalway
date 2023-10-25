<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('escolas', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('cidade_id');
            $table->foreignId('cidade_id');
            $table->string('nome');
            $table->integer('tipo')->comment('publica/privada');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('escolas');
    }
};
