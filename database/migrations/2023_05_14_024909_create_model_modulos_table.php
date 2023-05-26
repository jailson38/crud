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
        Schema::create('modulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('route')->unique();
            $table->string('resource');
            $table->text('description');
            $table->integer('parent')->unsigned();
            $table->foreign('parent')->references('id')->on('modulos')->onDlete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulos');
    }
};
