<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConveniadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conveniados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('convenio_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_edicao')->nullable();
            $table->unsignedBigInteger('user_exclusao')->nullable();
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('email', 100)->nullable();
            $table->string('telefone', 10);
            $table->string('telefone_secundario', 10)->nullable();
            $table->enum('situacao', ['Ativo', 'Inativo'])->default('Ativo');
            $table->string('endereco', 100);
            $table->string('bloco', 50);
            $table->string('apartamento', 10);
            $table->text('observacao')->nullable();
            

            $table->foreign('convenio_id', 'fk_convenio')
                ->references('id')
                ->on('convenios')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('user_id', 'fk_user_incl')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('user_edicao', 'fk_user_edic')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('user_exclusao', 'fk_user_excl')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conveniados');
    }
}
