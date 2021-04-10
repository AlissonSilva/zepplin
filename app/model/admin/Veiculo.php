<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{

    protected $fillable = [
        'descricao_veiculo', 'modelo', 'fabricante', 'placa', 'ano', 'fabricacao', 'cor', 'observacao',  'id_cliente'

    //'descricao_veiculo', 'modelo', 'fabricante', 'placa' , 'ano', 'fabricacao','cor','observacao', 'id_cliente'
    ];
}
