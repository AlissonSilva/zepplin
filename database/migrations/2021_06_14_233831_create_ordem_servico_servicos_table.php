<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemServicoServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //'id_ordemservico', 'id_servico', 'data_hora_finalizacao', 'status_servico', 'id_funcionario'
        Schema::create('ordem_servico_servicos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ordemservico')->unsigned();
            $table->integer('id_servico')->unsigned();
            $table->dateTime('data_hora_inicio')->nullable();
            $table->dateTime('data_hora_finalizacao')->nullable();
            $table->enum('status_servico', ['Não Iniciado', 'Em Andamento', 'Finalizado', 'Pausado'])->default('Não Iniciado');
            $table->biginteger('id_funcionario')->nullable()->unsigned();
            $table->foreign('id_funcionario')->references('id')->on('users');
            $table->foreign('id_ordemservico')->references('id_ordemservico')->on('ordem_servicos');
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
        Schema::dropIfExists('ordem_servico_servicos');
    }
}
