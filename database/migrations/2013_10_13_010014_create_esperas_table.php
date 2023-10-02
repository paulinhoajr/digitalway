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
            $table->unsignedBigInteger('escola_id');
            $table->unsignedBigInteger('cpf');
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
