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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            //$table->integer('cidade_id');
            $table->foreignId('cidade_id')->nullable();
            //$table->integer('escola_id');
            $table->foreignId('escola_id')->nullable();
            $table->string('nome');
            $table->string('pdf');
            $table->longText('descricao');
            $table->integer('situacao');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
