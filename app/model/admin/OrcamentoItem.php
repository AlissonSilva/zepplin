<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class OrcamentoItem extends Model
{
    protected $fillable = [
        'id_orcamento', 'id_produto', 'id_servico', 'quantidade' ,'valor_desconto', 'percentual_desconto', 'valor_total_sem_desconto', 'valor_total', 'id_user'
    ];
}
