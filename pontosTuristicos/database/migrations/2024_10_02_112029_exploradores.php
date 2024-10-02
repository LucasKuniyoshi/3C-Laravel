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
        Schema::create('explorers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('idade');
            $table->string('latitude');
            $table->string('longitude');
            // $table->string('password');
            $table->rememberToken(); //guarda quem está concetado atraves do token para q somente ela possa fazer alterações
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('explorers');
    }
};
