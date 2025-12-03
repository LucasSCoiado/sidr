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
        Schema::create('remedios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255)->nullable();
            $table->integer('quantidadeCaixa')->nullable();
            $table->integer('quantidadeTomada')->nullable();
            $table->integer('qtdRestante')->nullable();
            $table->integer('dose')->nullable();
            $table->integer('frequencia')->nullable();
            $table->integer('caixas')->nullable();
            $table->integer('miligramas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remedios');
    }
};
