<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $fillable = [
        'id_pessoa_fisica', 'id_pessoa_juridica'
    ];
}
