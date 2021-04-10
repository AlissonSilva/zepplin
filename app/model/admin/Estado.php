<?php

namespace App\model\admin;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = [
        'uf', 'estado'
    ];
}
