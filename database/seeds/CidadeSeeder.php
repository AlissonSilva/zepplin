<?php

use Illuminate\Database\Seeder;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cidades')->insert (
            array(
                array(
                    'cidade' => 'GOIÂNIA',
                    'id_estado' => 1,
                    'ibge'=>0,
                    'ddd'=>62,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'SÃO PAULO',
                    'id_estado' => 2,
                    'ibge'=>0,
                    'ddd'=>11,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'RIO DE JANEIRO',
                    'id_estado' => 3,
                    'ibge'=>0,
                    'ddd'=>21,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'RIO BRANCO',
                    'id_estado' => 4,
                    'ibge'=>0,
                    'ddd'=>68,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'MACEIÓ',
                    'id_estado' => 5,
                    'ibge'=>0,
                    'ddd'=>82,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'MACAPÁ',
                    'id_estado' => 6,
                    'ibge'=>0,
                    'ddd'=>96,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'MANAUS',
                    'id_estado' => 7,
                    'ibge'=>0,
                    'ddd'=>92,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'SALVADOR',
                    'id_estado' => 8,
                    'ibge'=>0,
                    'ddd'=>71,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'FORTALEZA',
                    'id_estado' => 9,
                    'ibge'=>0,
                    'ddd'=>85,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'VITORIA',
                    'id_estado' => 10,
                    'ibge'=>0,
                    'ddd'=>27,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'SÃO LUÍS',
                    'id_estado' => 11,
                    'ibge'=>0,
                    'ddd'=>98,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'CUIABA',
                    'id_estado' => 12,
                    'ibge'=>0,
                    'ddd'=>65,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'CAMPO GRANDE',
                    'id_estado' => 13,
                    'ibge'=>0,
                    'ddd'=>67,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'BELO HORIZONTE',
                    'id_estado' => 14,
                    'ibge'=>0,
                    'ddd'=>31,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'BELO HORIZONTE',
                    'id_estado' => 14,
                    'ibge'=>0,
                    'ddd'=>31,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'BELÉM',
                    'id_estado' => 15,
                    'ibge'=>0,
                    'ddd'=>91,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'JOÃO PESSOA',
                    'id_estado' => 16,
                    'ibge'=>0,
                    'ddd'=>83,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'CURITIBA',
                    'id_estado' => 17,
                    'ibge'=>0,
                    'ddd'=>41,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'RECIFE',
                    'id_estado' => 18,
                    'ibge'=>0,
                    'ddd'=>81,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'TERESINA',
                    'id_estado' => 19,
                    'ibge'=>0,
                    'ddd'=>86,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'NATAL',
                    'id_estado' => 20,
                    'ibge'=>0,
                    'ddd'=>84,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'PORTO ALEGRE',
                    'id_estado' => 21,
                    'ibge'=>0,
                    'ddd'=>51,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'PORTO VELHO',
                    'id_estado' => 22,
                    'ibge'=>0,
                    'ddd'=>69,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'BOA VISTA',
                    'id_estado' => 23,
                    'ibge'=>0,
                    'ddd'=>95,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'FLORIANÓPOLIS',
                    'id_estado' => 24,
                    'ibge'=>0,
                    'ddd'=>48,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'ARACAJU',
                    'id_estado' => 25,
                    'ibge'=>0,
                    'ddd'=>79,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'PALMAS',
                    'id_estado' => 26,
                    'ibge'=>0,
                    'ddd'=>63,
                    'capital'=>true
                ),

                array(
                    'cidade' => 'BRASILIA',
                    'id_estado' => 27,
                    'ibge'=>0,
                    'ddd'=>61,
                    'capital'=>true
                )

            )
        );
    }
}
