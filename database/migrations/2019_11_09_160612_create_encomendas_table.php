<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncomendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encomendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_criacao');
            $table->unsignedBigInteger('user_confirmacao')->nullable();
            $table->unsignedBigInteger('user_solicitacao')->nullable();
            $table->unsignedBigInteger('user_exclusao')->nullable();
            $table->string('nome');
            $table->string('contato')->nullable();
            $table->text('descricao');
            $table->tinyInteger('quantidade');
            $table->decimal('preco', 8, 2);
            $table->date('previsao');
            $table->timestamp('entrega')->nullable();
            $table->enum('situacao_pedido', ['Pendente', 'Solicitado', 'Cancelada', 'Entregue'])->default('Pendente');

            $table->foreign('user_criacao', 'fk_user_criacao')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('user_confirmacao', 'fk_user_confirmacao')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('user_solicitacao', 'fk_user_solicitacao')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('user_exclusao', 'fk_user_exclusao')
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
        Schema::dropIfExists('encomendas');
    }
}
