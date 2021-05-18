<?php

use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('produtos')->insert(
            array(
                array(
                    'descricao' => 'KIT CORREIA DENTADA VOLKSWAGEN GOL, CROSSFOX, FOX',
                    'unidade' => 'UN',
                    'preco' => 105.00,
                    'estoque' => 105,
                    'ativo' => true
                ),
                array(
                    'descricao' => 'KIT CORREIA DENTADA GM CORSA E CELTA',
                    'unidade' => 'UN',
                    'preco' => 210.00,
                    'estoque' => 105,
                    'ativo' => true
                ),
                array(
                    'descricao' => 'KIT REVISÃO CELTA/PRISMA',
                    'unidade' => 'UN',
                    'preco' => 128.00,
                    'estoque' => 105,
                    'ativo' => true
                ),
                array(
                    'descricao' => 'Coxim Completo Do Amortecedor Dianteiro Original Renault Clio E Kangoo Todos 99 Até 2016',
                    'unidade' => 'UN',
                    'preco' => 160.00,
                    'estoque' => 105,
                    'ativo' => true
                ),

                array(
                    'descricao' => 'Terminal Maciço 95mm Curto Tcm',
                    'unidade' => 'UN',
                    'preco' => 35.00,
                    'estoque' => 105,
                    'ativo' => true
                ),

                array(
                    'descricao' => 'Kit 4 Bucha Braço Barra Estabilizadora Traseira Peugeot 206 207 Sw',
                    'unidade' => 'UN',
                    'preco' => 325.00,
                    'estoque' => 105,
                    'ativo' => true
                )
            )

        );
    }
}
