<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_servicos', function (Blueprint $table) {
            $table->increments('id_ordemservico');
            $table->integer('id_orcamento')->unsigned();
            $table->integer('id_cliente')->unsigned();
            $table->biginteger('id_funcionario')->nullable()->unsigned();
            $table->date('data_geracao')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
            $table->date('data_previsao')->default('1900-01-01')->nullable();
            $table->date('data_finalizacao')->default('1900-01-01')->nullable();
            $table->enum('prioridade', ['baixa', 'media', 'alta'])->default('baixa');
            $table->enum('status_servico', ['não iniciado', 'iniciado', 'pausado', 'finalizado'])->default('não iniciado');
            $table->integer('id_veiculo')->unsigned();
            $table->biginteger('id_user')->unsigned();
            $table->text('observacao')->nullable();
            $table->timestamps();
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
            $table->foreign('id_orcamento')->references('id_orcamento')->on('orcamentos');
            $table->foreign('id_funcionario')->references('id')->on('users');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_veiculo')->references('id_veiculo')->on('veiculos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordem_servicos');
    }
}
