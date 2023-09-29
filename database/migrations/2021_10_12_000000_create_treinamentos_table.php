<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('treinamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cidade_id');
            $table->unsignedBigInteger('escola_id')
                ->nullable()
                ->comment("pode nao ser ligado a uma escola");
            //$table->foreign('cidade_id')->references('id')->on('cidades');
            $table->string('nome');
            $table->string('qrcode')->comment('liberar certificado ?');
            $table->longText('descricao');
            $table->integer('tipo')->comment('tem que ver, mas pode ser pra todos ou limitado');
            $table->integer('situacao');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treinamentos');
    }
};
