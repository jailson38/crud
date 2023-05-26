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
        Schema::create('veiculos_categoria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('vl_hora', 10, 2);
            $table->double('vl_diaria', 10, 2);
            $table->double('vl_semana', 10, 2);
            $table->double('vl_mes', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos_categoria');
    }
};
