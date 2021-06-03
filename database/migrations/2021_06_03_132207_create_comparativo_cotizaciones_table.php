<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComparativoCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comparativo_cotizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->json('detalle_comparativo');
            $table->integer('cotizacion_id')->unsigned();
            $table->foreign('cotizacion_id')->references('id')->on('solicitudes_cotizaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comparativo_cotizaciones');
    }
}
