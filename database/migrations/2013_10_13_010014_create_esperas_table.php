<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('esperas', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('escola_id');
            $table->foreignId('escola_id');
            $table->string('cpf', 11);
            $table->string('nome');
            $table->string('email')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('esperas');
    }
};
