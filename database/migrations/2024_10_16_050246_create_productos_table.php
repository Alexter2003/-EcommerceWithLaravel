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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('idProductos');
            $table->string('Nombre');
            $table->string('Descripcion');
            $table->integer('Precio');
            $table->bigInteger('idMarcas')->unsigned();
            $table->foreign('idMarcas')->references('idMarcas')->on('marcas');
            $table->boolean('estado')->default(1); // 1: Activo, 0: Inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
