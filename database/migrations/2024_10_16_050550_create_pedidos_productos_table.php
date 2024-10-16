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
        Schema::create('pedidos_productos', function (Blueprint $table) {
            $table->id('idPedidos_Productos');
            $table->integer('Cantidad');
            $table->bigInteger('idPedidos')->unsigned();
            $table->foreign('idPedidos')->references('idPedidos')->on('pedidos');
            $table->bigInteger('idProductos')->unsigned();
            $table->foreign('idProductos')->references('idProductos')->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_productos');
    }
};
