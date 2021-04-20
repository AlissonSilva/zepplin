<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class OrcamentoPagamento extends Model
{
    protected $fillable = [
        'id_pagamento', 'id_agente', 'id_pagamento', 'id_banco', 'parcelas', 'valor_parcela', 'valor_total'
    ];
}
