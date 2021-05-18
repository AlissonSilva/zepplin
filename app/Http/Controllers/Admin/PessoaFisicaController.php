<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\admin\cadastro\PessoaFisica;
use App\model\admin\Cidade;
use App\model\admin\Estado;
use App\model\admin\Cliente;
use App\model\admin\Veiculo;

class PessoaFisicaController extends Controller
{
    public function index()
    {
        $registros = PessoaFisica::all();
        return view('admin.pessoafisica.index', compact('registros'));
    }

    public function adicionar()
    {
        $estados = Estado::all();
        return view('admin.pessoafisica.adicionar', compact('estados'));
    }

    public function verificarCpfExistente($cpf)
    {
        //select replace(replace(cpf,'-',''),'.','') from pessoa_fisicas

        $count = PessoaFisica::where('pessoa_fisicas.cpf', $cpf)->count();
        if ($count) {
            return array(['status' => 'false', 'msg' => 'CPF já cadastrado na base']);
        }
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

        if ($this->verificarCpfExistente($dados['cpf'])) {
            return redirect()->json(['status' => 'false', 'msg' => '<div class="alert alert-danger" role="alert">CPF já cadastrado na base</div>']);
        } else {
            try {
                // dd($dados);
                PessoaFisica::create($dados);
                return response()->json(['status' => 'true', 'msg' => '<div class="alert alert-success" role="alert"> Pessoa cadastrada com sucesso. </div>', 'status' => 'true']);
            } catch (\Throwable $e) {
                return response()->json(['status' => 'true', 'msg' => '<div class="alert alert-danger" role="alert"> Erro ao salvar o cadastro. ' . $e->getMessage() . ' </div>', 'status' => 'false']);;
            }
        }
        // return redirect()->json(['teste'=>'teste']);
    }

    public function editar($id)
    {
        $estados = Estado::all();
        $registros = PessoaFisica::where('pessoa_fisicas.id_pessoa_fisica', $id)->first();
        $optMunicipio = Cidade::where('cidades.id_cidade', $registros['id_cidade'])->first();
        $municipios = Cidade::where('cidades.id_estado', $optMunicipio['id_estado'])->get();
        $cliente = Cliente::where('clientes.id_pessoa_fisica', $id)->first();
        if (isset($cliente['id_cliente'])) {
            $veiculo = Veiculo::where('veiculos.id_cliente', $cliente['id_cliente'])->first();
        } else {
            $veiculo = null;
        }


        return view('admin.pessoafisica.editar', compact('veiculo', 'registros', 'estados', 'optMunicipio', 'municipios', 'cliente'));
    }

    public function atualizar(Request $request, $id)
    {
        $dados = $request->all();

        //dd($dados);
        unset($dados['_token']);
        unset($dados['_method']);
        unset($dados['id_estado']);


        if (isset($dados['cliente'])) {
            if ($dados['cliente'] == 'false') {
                $dados['cliente'] = 0;
            } else {
                $dados['cliente'] = 1;
            }
        } else {
            $dados['cliente'] = 0;
        }

        if (isset($dados['fornecedor'])) {

            if ($dados['fornecedor'] == 'false') {
                $dados['fornecedor'] = 0;
            } else {
                $dados['fornecedor'] = 1;
            }
        } else {
            $dados['fornecedor'] = 0;
        }

        PessoaFisica::where('pessoa_fisicas.id_pessoa_fisica', $id)->update($dados);
        //return redirect()->route('admin.pessoafisica');
        return back()->with(['success' => 'Cadastro atualizado com sucesso.']);
    }
}
