<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoaFisicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa_fisicas', function (Blueprint $table) {
            $table->increments('id_pessoa_fisica');
            $table->string('nome',255);
            $table->date('dtnascimento');
            $table->string('cpf',16)->unique();
            $table->enum('sexo',['f','m','o']);
            $table->integer('rg');
            $table->string('orgaoexpedidor',50);
            $table->string('email',255);
            $table->integer('id_cidade')->unsigned();
            $table->string('cep',25);
            $table->text('endereco');
            $table->integer('numero')->default(0);
            $table->text('complemento');
            $table->string('bairro',150);
            $table->string('telefone',30);
            $table->string('celular', 30);
            $table->boolean('fornecedor')->default(false);
            $table->boolean('cliente')->default(false);
            $table->foreign('id_cidade')->references('id_cidade')->on('cidades');
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
        Schema::dropIfExists('pessoa_fisicas');
    }
}
