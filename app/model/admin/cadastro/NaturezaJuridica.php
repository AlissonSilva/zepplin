<?php

namespace App\model\admin\cadastro;

use Illuminate\Database\Eloquent\Model;

class NaturezaJuridica extends Model
{
    protected $fillable = [
        'cod_natureza_juridica','natureza_juridica', 'representante', 'qualificacao'
    ];
}
