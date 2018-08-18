<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSafrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cultura', 100);
            $table->string('ano', 4);
            $table->integer('producao');
            $table->float('valor_unitario', 8, 2);
            $table->float('receita_total', 8, 2);
            $table->unsignedInteger('unidade_id');
            $table->unsignedInteger('lavoura_id');
            $table->timestamps();

            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->foreign('lavoura_id')->references('id')->on('lavouras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('safras');
    }
}
