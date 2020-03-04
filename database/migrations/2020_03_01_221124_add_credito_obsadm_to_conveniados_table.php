<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreditoObsadmToConveniadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conveniados', function (Blueprint $table) {
            $table->enum('credito', ['Liberado', 'Bloqueado'])->default('Liberado');
            $table->text('observacao_administracao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conveniados', function (Blueprint $table) {
            $table->dropColumn('credito');
            $table->dropColumn('observacao_administracao');
        });
    }
}
