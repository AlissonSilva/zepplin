<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\admin\cadastro\PessoaFisica;
use App\model\admin\Cidade;
use App\model\admin\Estado;

class PessoaFisicaController extends Controller
{
    public function index()
    {
        return PessoaFisica::all();
    }

    public function pginicial()
    {
        return response()->json(['message' => 'SIGOM - API', 'status' => 'Connected']);
    }

    public function inserir(Request $request)
    {
        $dados = $request->all();
        PessoaFisica::create($dados);
    }
}
