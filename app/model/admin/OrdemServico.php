<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    protected $fillable = [
        'id_orcamento', 'id_cliente', 'id_funcionario', 'data_geracao', 'data_previsao', 'data_finalizacao', 'prioridade', 'status_servico', 'id_veiculo', 'id_user', 'observacao'
    ];
}
