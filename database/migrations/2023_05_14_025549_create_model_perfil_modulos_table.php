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
        Schema::create('perfil_modulos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_perfil')->unsigned();
            $table->integer('fk_usuario')->unsigned();
            $table->foreign('fk_perfil')->references('id')->on('usuario_perfil')->onDlete('cascade')->onUpdate('cascade');
            $table->foreign('fk_usuario')->references('id')->on('usuarios')->onDlete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_modulos');
    }
};
