<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrcamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->increments('id_orcamento');
            $table->float('valor_desconto')->default(0.0);
            $table->float('percentual_desconto')->default(0.0);
            $table->float('valor_total_sem_desconto')->default(0.0);
            $table->float('valor_total')->default(0.0);
            // a-aberto; f-fechado; c-cancelado; aprovado
            $table->enum('status_orcamento', ['aberto', 'fechado', 'cancelado', 'aprovado'])->default('aberto');
            $table->integer('id_cliente')->unsigned();
            $table->integer('id_veiculo')->nullable()->unsigned();
            $table->integer('id_user')->unsigned();
            $table->enum('salvo', [1, 0])->default(0);
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
            $table->foreign('id_veiculo')->references('id_veiculo')->on('veiculos');
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
        Schema::dropIfExists('orcamentos');
    }
}
