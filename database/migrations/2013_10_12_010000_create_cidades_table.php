<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estado_id')->unsigned();
            $table->integer('ibge');
            $table->string('nome');
            $table->string('uf');
            $table->string('cep')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        /*Schema::table('cities', function (Blueprint $table) {
            $table->foreign('state_id')->references('id')->on('states');
        });*/
    }

    public function down(): void
    {
        Schema::dropIfExists('cidades');
    }
};
