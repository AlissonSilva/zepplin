<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'descricao', 'estoque', 'preco', 'ativo', 'unidade', 
    ];
}
