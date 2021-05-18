<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        $registros = Produto::all();
        return view('admin.produto.index', compact('registros'));
    }

    public function adicionar()
    {
        return view('admin.produto.adicionar');
    }

    public function editar($id_produto)
    {
        $registros = Produto::where('produtos.id_produto', $id_produto)->first();
        return view('admin.produto.editar', compact('registros'));
    }

    public function atualizar(Request $request, $id_produto)
    {
        //dd($request);

        if (empty($request->descricao)) {
            return response()->json(['msg' => '<div class="alert alert-danger"> O campo descrição é obrigatório.</div>', 'tipo' => 'false']);
        } else if (empty($request->preco)) {
            return response()->json(['msg' => '<div class="alert alert-danger">O campo valor é obrigatório.</div>', 'tipo' => 'false']);
        } else {
            $dados = $request->all();
            unset($dados['_token']);
            unset($dados['_method']);

            isset($dados['ativo']) ? ($dados['ativo']==true ? 1 : 0) : 0;
            if (isset($dados['ativo']) && $dados['ativo'] == 'true') {
                $dados['ativo'] = 1;
            } else {
                $dados['ativo'] = 0;
            }

            // dd($dados);
            Produto::where('produtos.id_produto', $id_produto)->update($dados);
            // return redirect()->route('admin.produtos');
            return back()->with('success','Item atualizado com sucesso.');
        };
    }

    public function inserir(Request $request)
    {
        if (empty($request->descricao)) {
            return response()->json(['msg' => '<div class="alert alert-danger"> O campo descrição é obrigatório.</div>', 'tipo' => 'false']);
        } else if (empty($request->preco)) {
            return response()->json(['msg' => '<div class="alert alert-danger">O campo valor é obrigatório.</div>', 'tipo' => 'false']);
        } else {
            $dados = $request->all();
            if ($dados['ativo'] == 'true') {
                $dados['ativo'] = 1;
            } else if ($dados['ativo'] == 'false') {
                $dados['ativo'] = 0;
            }

            // dd($dados);
            try {    
                Produto::create($dados);
                return response()->json(['msg' => '<div class="alert alert-success">Produto cadastrado com sucesso.</div>', 'tipo' => 'true']);
            } catch (\Throwable $th) {
                return response()->json(['msg' => '<div class="alert alert-danger">Erro técnico ao inserir '.$th->getMessage().'</div>', 'tipo' => 'false']);
            }
        }
    }
}
