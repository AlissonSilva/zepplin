<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $fillable = [
        'cidade', 'uf', 'ibge', 'id_estado', 'ddd', 'capital'
    ];


}
