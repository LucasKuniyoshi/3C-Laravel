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
        Schema::create('testamentos', function (Blueprint $table) {
            $table->id(); //PRIMARY KEY
            $table->string('nome')->unique();
            $table->timestamps(); //DATA DE CRIAÇÃO
        });
    }

    /**
     * Reverse the migrations.
     */
    // CASO DE ALGUM ERRO, DA PRA DAR UM DROP NA TABELA
    public function down(): void
    {
        Schema::dropIfExists('testamentos');
    }
};
