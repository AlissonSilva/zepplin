<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrcamentoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamento_items', function (Blueprint $table) {
            $table->increments('id_orcamento_item');
            $table->integer('id_orcamento')->unsigned();
            $table->integer('id_produto')->nullable()->unsigned();
            $table->integer('id_servico')->nullable()->unsigned();
            $table->integer('quantidade')->default(0);
            $table->float('valor_desconto')->default(0.0);
            $table->float('percentual_desconto')->default(0.0);
            $table->float('valor_total_sem_desconto')->default(0.0);
            $table->float('valor_total')->default(0.0);
            $table->integer('id_user')->unsigned();
            $table->foreign('id_orcamento')->references('id_orcamento')->on('orcamentos');
            $table->foreign('id_produto')->references('id_produto')->on('produtos');
            $table->foreign('id_servico')->references('id_servico')->on('servicos');
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
        Schema::dropIfExists('orcamento_items');
    }
}
