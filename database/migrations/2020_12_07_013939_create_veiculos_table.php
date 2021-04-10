<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //'descricao_veiculo', 'modelo', 'fabricante', 'placa' , 'ano', 'fabricacao','cor','observacao', 'id_cliente'
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->increments('id_veiculo');
            $table->string('descricao_veiculo', 255);
            $table->string('modelo', 255);
            $table->string('fabricante', 255);
            $table->string('placa', 50);
            $table->integer('ano');
            $table->integer('fabricacao');
            $table->string('cor', 100);
            $table->string('observacao', 5000);
            $table->integer('id_cliente')->unsigned();
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
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
        Schema::dropIfExists('veiculos');
    }
}
