<?php

use Illuminate\Database\Seeder;

class BancoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bancos')->insert(
            array(
                array(
                    'codigo' => 1,
                    'descricao' => 'BANCO DO BRASIL S. A.',
                    'status_banco'=>1
                ),
                
                array(
                    'codigo' => 4,
                    'descricao' => 'BANCO DO NORDESTE DO BRASIL S. A.',
                    'status_banco'=>1
                ),
                
                array(
                    'codigo' => 33,
                    'descricao' => 'BANCO SANTANDER (BRASIL) S. A.',
                    'status_banco'=>1
                ),
                
                array(
                    'codigo' => 77,
                    'descricao' => 'BANCO INTERMEDIUM S. A.',
                    'status_banco'=>0
                ),
                array(
                    'codigo' => 104,
                    'descricao' => 'CAIXA ECONÔMICA FEDERAL',
                    'status_banco'=>1
                ),
                array(
                    'codigo' => 212,
                    'descricao' => 'BANCO ORIGINAL S. A.',
                    'status_banco'=>1
                ),
                array(
                    'codigo' => 224,
                    'descricao' => 'BANCO FIBRA S. A.',
                    'status_banco'=>1
                ),
                array(
                    'codigo' => 237,
                    'descricao' => 'BANCO BRADESCO S. A.',
                    'status_banco'=>1
                ),
                array(
                    'codigo' => 246,
                    'descricao' => 'BANCO ABC BRASIL S. A.',
                    'status_banco'=>1
                ),
                array(
                    'codigo' => 341,
                    'descricao' => 'ITAÚ UNIBANCO S.A.',
                    'status_banco'=>1
                ),
                array(
                    'codigo' => 399,
                    'descricao' => 'HSBC BANK S.A.',
                    'status_banco'=>1
                ),
                array(
                    'codigo' => 422,
                    'descricao' => 'BANCO SAFRA',
                    'status_banco'=>1
                )

            )

        );
    }
}
