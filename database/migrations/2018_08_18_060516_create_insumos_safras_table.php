<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsumosSafrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos_safras', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("quantidade");
            $table->float("custo_unitario", 8, 2);
            $table->float("custo_total", 8, 2);
            $table->unsignedInteger("safra_id");
            $table->unsignedInteger("insumo_id");
            $table->unsignedInteger("incidente_id"); 
            $table->timestamps();

            $table->foreign('safra_id')->references('id')->on('safras');
            $table->foreign('insumo_id')->references('id')->on('insumos');
            $table->foreign('incidente_id')->references('id')->on('incidentes');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insumos_safras');
    }
}
