<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $fillable = [
        'descricao', 'preco', 'ativo', 'unidade'
    ];
}
