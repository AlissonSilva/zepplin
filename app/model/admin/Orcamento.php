<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    // id_orcamente; valor; status_orcamento; id_cliente; id_veiculo

    protected $fillable = [
        'valor_desconto', 'percentual_desconto', 'valor_total_sem_desconto', 'valor_total', 'status_orcamento', 'id_cliente', 'id_veiculo', 'id_user', 'salvo'
    ];
}
