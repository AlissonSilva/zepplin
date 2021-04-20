<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrcamentoPagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamento_pagamentos', function (Blueprint $table) {
            $table->increments('id_orcamento_pagamento');
            $table->integer('id_orcamento')->unsigned();
            $table->integer('id_agente')->unsigned();
            $table->integer('id_pagamento')->unsigned();
            $table->integer('id_banco')->unsigned();
            $table->integer('parcelas');
            $table->double('valor_parcela');
            $table->double('valor_total');
            $table->foreign('id_orcamento')->references('id_orcamento')->on('orcamentos');
            $table->foreign('id_agente')->references('id_agente')->on('agentes');
            $table->foreign('id_pagamento')->references('id_pagamento')->on('pagamentos');
            $table->foreign('id_banco')->references('id_banco')->on('bancos');
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
        Schema::dropIfExists('orcamento_pagamentos');
    }
}
