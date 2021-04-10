<?php

use Illuminate\Database\Seeder;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('servicos')->insert (
            array(
                    array(
                        'descricao'=>'MÃO DE OBRA SIMPLES',
                        'unidade'=>'UN',
                        'preco'=>20.00,
                        'ativo'=>true
                    ),
                    array(
                        'descricao'=>'MÃO DE OBRA INTERMEDIÁRIA',
                        'unidade'=>'UN',
                        'preco'=>50.00,
                        'ativo'=>true
                    ),
                    array(
                        'descricao'=>'MÃO DE OBRA COMPLEXA',
                        'unidade'=>'UN',
                        'preco'=>100.00,
                        'ativo'=>true
                    ),
                    array(
                        'descricao'=>'TROCA DE ÓLEO',
                        'unidade'=>'UN',
                        'preco'=>60.00,
                        'ativo'=>true
                    ),

                    array(
                        'descricao'=>'ALINHAMENTO E BALANCEAMENTO COMPLETO',
                        'unidade'=>'UN',
                        'preco'=>100.00,
                        'ativo'=>true
                    ),

                    array(
                        'descricao'=>'ALINHAMENTO E BALANCEAMENTO UNITARIO',
                        'unidade'=>'UN',
                        'preco'=>25.00,
                        'ativo'=>true
                    )
            )

        );
    }
}
