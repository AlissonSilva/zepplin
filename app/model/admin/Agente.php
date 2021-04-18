<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    protected $fillable = [
        'codigo', 'titular', 'id_banco', 'tipo_conta', 'status_agente', 'agencia', 'conta', 'digito'
    ];
}
