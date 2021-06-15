<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServicoServico extends Model
{
    // use HasFactory;
    protected $fillable = [
        'id_ordemservico', 'id_servico', 'data_hora_inicio', 'data_hora_finalizacao', 'status_servico', 'id_funcionario'
    ];
}
