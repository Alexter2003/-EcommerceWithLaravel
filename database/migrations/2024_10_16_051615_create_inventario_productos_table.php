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
        Schema::create('inventario_productos', function (Blueprint $table) {
            $table->id('idInventarios_Productos');
            $table->bigInteger('idSucursal')->unsigned();
            $table->foreign('idSucursal')->references('idSucursal')->on('sucursal');
            $table->bigInteger('idProductos')->unsigned();
            $table->foreign('idProductos')->references('idProductos')->on('productos');
            $table->bigInteger('idUsuario')->unsigned();
            $table->foreign('idUsuario')->references('idUsuario')->on('usuarios');
            $table->integer('Cantidad');
            $table->date('FechaCompra');
            $table->string('Lote');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario_productos');
    }
};
