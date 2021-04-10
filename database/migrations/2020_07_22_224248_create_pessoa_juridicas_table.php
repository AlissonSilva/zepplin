<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoaJuridicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa_juridicas', function (Blueprint $table) {
            $table->increments('id_pessoa_juridica');
            $table->string('razao_social',200);
            $table->string('fantasia',200);
            $table->string('cnpj',20);
            $table->string('cod_natureza_juridica', 15);
            $table->date('data_abertura');
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
            $table->foreign('cod_natureza_juridica')->references('cod_natureza_juridica')->on('natureza_juridicas');
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
        Schema::dropIfExists('pessoa_juridicas');
    }
}
