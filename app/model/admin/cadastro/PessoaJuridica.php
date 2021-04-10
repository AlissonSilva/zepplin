<?php

namespace App\model\admin\cadastro;

use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Model
{
    protected $fillable = [
        'razao_social','fantasia','cnpj','data_abertura','cod_natureza_juridica','email','id_cidade','cep','endereco','numero','complemento','bairro','telefone','celular', 'fornecedor','cliente'
    ];
}
