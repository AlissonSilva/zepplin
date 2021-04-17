<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $fillable = [
        'codigo', 'descricao', 'status_banco'
    ];
}
