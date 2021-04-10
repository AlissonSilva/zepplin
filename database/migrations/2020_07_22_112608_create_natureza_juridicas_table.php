<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNaturezaJuridicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('natureza_juridicas', function (Blueprint $table) {
            $table->string('cod_natureza_juridica',15)->primary();
            $table->string('natureza_juridica',255);
            $table->string('representante',255);
            $table->string('qualificacao',150);
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
        Schema::dropIfExists('natureza_juridicas');
    }
}
