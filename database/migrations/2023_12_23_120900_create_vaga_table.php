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
        Schema::create('vaga', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->boolean('ocupada');
            $table->float('preco')->nullable();
            $table->time('horario_entrada')->nullable();
            $table->time('horario_saida')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('vaga');
        Schema::table('vaga', function (Blueprint $table) {
            $table->foreignId('usuario_id')->constrained()->onDelete('cascade');
        });
    }
};
