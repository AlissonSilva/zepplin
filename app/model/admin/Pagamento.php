<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $fillable = [
        'descricao', 'id_agente', 'numero_parcelas', 'intervalo_parcelas', 'status_pagamento'
    ];
}
