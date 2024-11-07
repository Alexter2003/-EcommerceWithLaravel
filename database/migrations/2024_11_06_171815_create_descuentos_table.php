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
        Schema::create('descuentos', function (Blueprint $table) {
            $table->id('idDescuento');
            $table->unsignedBigInteger('idProductos'); // Ajustado a idProductos
            $table->foreign('idProductos')
                ->references('idProductos')
                ->on('productos')
                ->onDelete('cascade');
            $table->unsignedBigInteger('idTipoDescuento'); // Ajustado a idTipoDescuento
            $table->foreign('idTipoDescuento')
                ->references('idTipoDescuento')
                ->on('tipo_descuento')
                ->onDelete('cascade');
            $table->decimal('Descuento', 8, 2);
            $table->date('FechaInicio');
            $table->date('FechaFin');
            $table->boolean('Estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descuentos');
    }
};
