<?php

use Illuminate\Database\Seeder;
use App\model\admin\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('estados')->insert (
            array(
            1 => array(
                'uf'=>'GO',
                'estado'=>'GOIÁS'
                ),
            2 => array(
                'uf'=>'SP',
                'estado'=>'SÃO PAULO'
                    ),
            3 => array(
                'uf'=>'RJ',
                'estado'=>'RIO DE JANEIRO'
             ),
            4 => array(
                'uf'=>'AC',
                'estado'=>'ACRE'
            ),
            5 => array(
                 'uf'=>'AL',
                 'estado'=>'ALAGOAS'
            ),

            6 => array(
                'uf'=>'AP',
                'estado'=>'AMAPÁ'
            ),
            7 => array(
                'uf'=>'AM',
                'estado'=>'AMAZONAS'
            ),
            8 => array(
                'uf'=>'BA',
                'estado'=>'BAHIA'
            ),
            9 => array(
                'uf'=>'CE',
                'estado'=>'CEARÁ'
            ),
            10 => array(
                'uf'=>'ES',
                'estado'=>'ESPÍRITO SANTO'
            ),
            11 => array(
                'uf'=>'MA',
                'estado'=>'MARANHÃO'
            ),
            12 =>array(
                'uf'=>'MT',
                'estado'=>'MATO GROSSO'
            ),
            13 => array(
                'uf'=>'MS',
                'estado'=>'MATO GROSSO DO SUL'
            ),
            14 => array(
                'uf'=>'MG',
                'estado'=>'MINAS GERAIS'
            ),
            15 => array(
                'uf'=>'PA',
                'estado'=>'PARÁ'
            ),
            16 => array(
                'uf'=>'PA',
                'estado'=>'PARAÍBA'
            ),
            17 => array(
                'uf'=>'PR',
                'estado'=>'PARANÁ'
            ),
            18 =>array(
                'uf'=>'PE',
                'estado'=>'PERNAMBUCO'
            ),
            19 => array(
                'uf'=>'PI',
                'estado'=>'PIAUÍ'
            ),
            20 => array(
                'uf'=>'RN',
                'estado'=>'RIO GRANDE DO NORTE'
            ),
            21 => array(
                'uf'=>'RS',
                'estado'=>'RIO GRANDE DO SUL'
            ),
            22 => array(
                'uf'=>'RO',
                'estado'=>'RONDÔNIA'
            ),
            23 => array(
                'uf'=>'RR',
                'estado'=>'RORAIMA'
            ),
            24 => array(
                'uf'=>'SC',
                'estado'=>'SANTA CATARINA'
            ),
            25 => array(
                'uf'=>'SE',
                'estado'=>'SERGIPE'
            ),
            26 => array(
                'uf'=>'TO',
                'estado'=>'TOCANTINS'
            ),
            27 => array(
                'uf'=>'DF',
                'estado'=>'DISTRITO FEDERAL'
            ),
        )

    );

   // Estado::create($dados);
    }
}
