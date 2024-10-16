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
        Schema::create('categorias_productos', function (Blueprint $table) {
            $table->id('idCategorias_Productos');
            $table->bigInteger('idProductos')->unsigned();
            $table->foreign('idProductos')->references('idProductos')->on('productos');
            $table->bigInteger('idCategorias')->unsigned();
            $table->foreign('idCategorias')->references('idCategorias')->on('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias_productos');
    }
};
