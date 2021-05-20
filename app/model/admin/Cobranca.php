<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Cobranca extends Model
{

    protected $fillable = [
        'id_cobranca', 'id_cliente', 'id_orcamento', 'data_geracao', 'data_vencimento', 'data_pagamento', 'data_recebimento', 'status_pagamento','id_agente','id_banco' ,'id_pagamento', 'num_parcela', 'valor_parcela', 'valor_recebido', 'valor_desconto', 'valor_multa', 'valor_juros', 'valor_total'
    ];

}
