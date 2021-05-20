<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCobrancasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobrancas', function (Blueprint $table) {
            $table->increments('id_cobranca');
            $table->integer('id_cliente')->unsigned();
            $table->integer('id_orcamento')->unsigned();
            $table->date('data_geracao')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
            $table->date('data_vencimento');
            $table->date('data_pagamento');
            $table->date('data_recebimento');
            $table->enum('status_pagamento', ['aberto', 'pendente', 'estornado']);
            $table->integer('id_agente')->unsigned();
            $table->integer('id_banco')->unsigned();
            $table->integer('id_pagamento')->unsigned();
            $table->integer('num_parcela');
            $table->float('valor_parcela');
            $table->float('valor_recebido');
            $table->float('valor_desconto');
            $table->float('valor_multa');
            $table->float('valor_juros');
            $table->float('valor_total');
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');
            $table->foreign('id_orcamento')->references('id_orcamento')->on('orcamentos');
            $table->foreign('id_agente')->references('id_agente')->on('agentes');
            $table->foreign('id_banco')->references('id_banco')->on('bancos');
            $table->foreign('id_pagamento')->references('id_pagamento')->on('pagamentos');
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
        Schema::dropIfExists('cobrancas');
    }
}
