<?php

use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('perfils')->insert (
            array(
                1 => array(
                    'descricao'=>'ADMINISTRADOR',
                    'admin'=>true,
                    'ativo'=>true
                ),
                2 => array(
                    'descricao'=>'MECÂNICO',    
                    'admin'=>false,
                    'ativo'=>true
                ),
                3 => array(
                    'descricao'=>'SECRETÁRIO',
                    'admin'=>false,
                    'ativo'=>true
                )

            )
        );
    }
}
