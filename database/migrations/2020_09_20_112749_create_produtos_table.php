<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id_produto');
            $table->string('descricao', 255);
            //UN - Unidade (padrão); CT - Cartela (1); CX - Caixa (1); DZ - Duzia (12); GS - Grosa (144); PA - Par (2); PÇ - Peça (1); PR - Par (2); PT - Pacote (1); RL - Rolo (1).
            $table->enum('unidade', ['UN', 'PC', 'CX', 'DZ', 'GS', 'PA', 'PR', 'PT', 'RL', 'CT']);
            $table->float('preco', 10, 2);
            $table->boolean('ativo')->default(true);
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
        Schema::dropIfExists('produtos');
    }
}
