<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPerfilPessoaTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('id_perfil')->nullable()->unsigned();
            $table->foreign('id_perfil')->references('id_perfil')->on('perfils');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('ativo')->default(1);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('id_pessoa_fisica')->nullable()->unsigned();
            $table->foreign('id_pessoa_fisica')->references('id_pessoa_fisica')->on('pessoa_fisicas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id_perfil');
            $table->dropColumn('id_pessoa_fisica');
            $table->dropColumn('ativo');
        });
    }
}
