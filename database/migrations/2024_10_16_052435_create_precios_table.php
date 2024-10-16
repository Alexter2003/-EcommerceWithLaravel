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
        Schema::create('precios', function (Blueprint $table) {
            $table->id('idPrecios');
            $table->date('Fecha');
            $table->integer('Precio');
            $table->string('Estado');
            $table->string('TipoPrecio');
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
        Schema::dropIfExists('precios');
    }
};
