<?php

namespace App\model\admin\cadastro;

use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    protected $fillable = [
        'nome','dtnascimento', 'cpf', 'sexo' , 'rg', 'orgaoexpedidor', 'email', 'id_cidade', 'cep', 'endereco', 'numero', 'complemento', 'bairro', 'telefone', 'celular', 'fornecedor', 'cliente'
    ];
}
