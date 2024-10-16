<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rols_usuarios', function (Blueprint $table) {
            $table->id('idRols_Usuarios');
            $table->bigInteger('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('idUsuario')->on('usuarios');
            $table->bigInteger('idRol')->unsigned();
            $table->foreign('idRol')->references('idRol')->on('Rols');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rols_usuarios');
    }
};
