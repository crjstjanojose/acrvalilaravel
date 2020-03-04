<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoEncomendaEncomendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('encomendas', function (Blueprint $table) {
            $table->enum('tipo_encomenda', ['Falta', 'Reposicao', 'Procura', 'Encomenda'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('encomendas', function (Blueprint $table) {
            $table->dropColumn('tipo_encomenda');
        });
    }
}
