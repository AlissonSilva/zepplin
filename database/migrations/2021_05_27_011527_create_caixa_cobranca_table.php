<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCaixaCobrancaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caixa_cobranca', function (Blueprint $table) {
            $table->integer('id_caixa')->unsigned();
            $table->integer('id_cobranca')->unsigned();
            $table->date('data_recebimento')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
            $table->foreign('id_caixa')->references('id_caixa')->on('caixas');
            $table->foreign('id_cobranca')->references('id_cobranca')->on('cobrancas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caixa_cobranca');
    }
}
