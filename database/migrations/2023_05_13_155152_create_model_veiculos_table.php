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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('montadora');
            $table->string('placa', 10);
            $table->text('descricao')->nullable();
            $table->text('observacoes')->nullable();
            $table->integer('fk_categoria')->unsigned();
            $table->text('image')->nullable();
            $table->foreign('fk_categoria')->references('id')->on('veiculos_categoria')->onDlete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
