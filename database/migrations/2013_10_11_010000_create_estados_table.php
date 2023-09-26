<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('uf');
            $table->integer('regiao_id')->unsigned();
            $table->softDeletes();
        });

        /*Schema::table('estados', function (Blueprint $table) {
            $table->foreign('regiao_id')->references('id')->on('regioes');
        });*/
    }

    public function down(): void
    {
        Schema::dropIfExists('estados');
    }
};
