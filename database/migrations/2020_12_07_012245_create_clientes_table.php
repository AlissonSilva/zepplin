<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id_cliente');
            $table->integer('id_pessoa_fisica')->nullable()->unsigned();
            $table->integer('id_pessoa_juridica')->nullable()->unsigned();
            $table->foreign('id_pessoa_fisica')->references('id_pessoa_fisica')->on('pessoa_fisicas')->onDelete('cascade');
            $table->foreign('id_pessoa_juridica')->references('id_pessoa_juridica')->on('pessoa_juridicas')->onDelete('cascade');
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
        Schema::dropIfExists('clientes');
    }
}
