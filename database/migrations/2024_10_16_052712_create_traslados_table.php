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
        Schema::create('traslados', function (Blueprint $table) {
            $table->id('idTraslados');
            $table->date('Fecha');
            $table->bigInteger('idProductos')->unsigned();
            $table->foreign('idProductos')->references('idProductos')->on('productos');
            $table->string('Estado');
            $table->integer('Cantidad');
            $table->bigInteger('idSucursal_Origen')->unsigned();
            $table->foreign('idSucursal_Origen')->references('idSucursal')->on('sucursal');
            $table->bigInteger('idSucursal_Destino')->unsigned();
            $table->foreign('idSucursal_Destino')->references('idSucursal')->on('sucursal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traslados');
    }
};
