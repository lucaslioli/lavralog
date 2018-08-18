<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableSafraFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('safras', function (Blueprint $table) {
            $table->integer('producao')->nullable()->change();
            $table->float('valor_unitario', 8, 2)->nullable()->change();
            $table->float('receita_total', 8, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('safras', function (Blueprint $table) {
            $table->integer('producao')->change();
            $table->float('valor_unitario', 8, 2)->change();
            $table->float('receita_total', 8, 2)->change();
        });
    }
}
