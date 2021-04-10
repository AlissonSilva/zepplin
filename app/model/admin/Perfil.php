<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $fillable = [
        'descricao', 'admin', 'ativo'
    ];
}
