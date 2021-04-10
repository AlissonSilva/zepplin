<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\admin\cadastro\PessoaJuridica;
use App\model\admin\Estado;
use App\model\admin\Cidade;
use App\model\admin\cadastro\NaturezaJuridica;
use App\model\admin\Cliente;
use App\model\admin\Veiculo;

class PessoaJuridicaController extends Controller
{
    public function index()
    {
        $registros = PessoaJuridica::where('id_pessoa_juridica', '<>', 0)->get();
        return view('admin.pessoajuridica.index', compact('registros'));
    }

    public function adicionar()
    {
        $estados = Estado::all();
        $naturezas = NaturezaJuridica::all();
        return view('admin.pessoajuridica.adicionar', compact('estados', 'naturezas'));
    }

    public function inserir(Request $request)
    {


        $dados = $request->all();



        unset($dados['_token']);
        unset($dados['id_estado']);

        if ($dados['cliente'] == 'false') {
            $dados['cliente'] = 0;
        } else {
            $dados['cliente'] = 1;
        }

        if ($dados['fornecedor'] == 'false') {
            $dados['fornecedor'] = 0;
        } else {
            $dados['fornecedor'] = 1;
        }

        dd($dados);
        PessoaJuridica::create($dados);
        return redirect()->json(['status' => 'true', 'msg' => '<div class="alert alert-sucess" role="alert">Pessoa Jurídica cadastrada com sucesso</div>']);
    }

    public function editar($id)
    {
        $registros = PessoaJuridica::where('id_pessoa_juridica', $id)->first();
        $naturezas = NaturezaJuridica::all();
        $estados = Estado::all();
        $cliente = Cliente::where('clientes.id_pessoa_juridica', $id)->first();
        $optMunicipio = Cidade::where('cidades.id_cidade', $registros['id_cidade'])->first();
        $municipios = Cidade::where('cidades.id_estado', $optMunicipio['id_estado'])->get();
        if (isset($cliente['id_cliente'])) {
            $veiculo = Veiculo::where('veiculos.id_cliente', $cliente['id_cliente'])->first();
        } else {
            $veiculo = null;
        }


        return view('admin.pessoajuridica.editar', compact('veiculo', 'cliente', 'registros', 'naturezas', 'estados', 'optMunicipio', 'municipios'));
    }

    public function atualizar(Request $request, $id)
    {
        $dados = $request->all();
        unset($dados['_token']);
        unset($dados['_method']);
        unset($dados['id_estado']);


        isset($dados['cliente']) ? $dados['cliente'] = 0 : $dados['cliente'] = 1;
        if ($dados['cliente'] == 'false') {
            $dados['cliente'] = 0;
        } else {
            $dados['cliente'] = 1;
        }

        isset($dados['fornecedor']) ? $dados['fornecedor'] = 0 : $dados['fornecedor'] = 1;
        if ($dados['fornecedor'] == 'false') {
            $dados['fornecedor'] = 0;
        } else {
            $dados['fornecedor'] = 1;
        }
        PessoaJuridica::where('id_pessoa_juridica', $id)->update($dados);
        return redirect()->route('admin.pessoajuridica');
    }
}
