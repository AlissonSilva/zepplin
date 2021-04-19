<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->increments('id_pagamento');
            $table->string('descricao');
            $table->integer('id_agente')->unsigned();
            $table->integer('numero_parcelas');
            $table->integer('intervalo_parcelas');
            $table->boolean('status_pagamento')->default(1);
            $table->foreign('id_agente')->references('id_agente')->on('agentes');
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
        Schema::dropIfExists('pagamentos');
    }
}
