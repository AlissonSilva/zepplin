<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agentes', function (Blueprint $table) {
            $table->increments('id_agente');
            $table->integer('codigo');
            $table->string('titular', 255);
            $table->integer('id_banco')->nullable()->unsigned();
            $table->enum('tipo_conta', ['Conta Corrente', 'Conta Poupança']);
            $table->boolean('status_agente')->default(1);
            $table->integer('agencia')->nullable();
            $table->integer('conta')->nullable();
            $table->string('digito')->nullable();
            $table->foreign('id_banco')->references('id_banco')->on('bancos')->onDelete('cascade');
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
        Schema::dropIfExists('agentes');
    }
}
