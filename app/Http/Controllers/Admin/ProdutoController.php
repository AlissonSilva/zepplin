<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Produto;
use Illuminate\Support\Facades\DB;
use PDF;

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

    public function relatorioestoque()
    {
        return view('admin.produto.relatorioestoque');
    }

    public function editar($id_produto)
    {
        $registros = Produto::where('produtos.id_produto', $id_produto)->first();
        return view('admin.produto.editar', compact('registros'));
    }

    public function createpdf(Request $request)
    {
        $dados = $request->all();
        // dd($dados);
        $ativo = 'true';
        $inativo = 'true';
        $query = '';

        $cod_prod_inicio = intval($dados['cod_prod_inicio']);
        $cod_prod_fim = intval($dados['cod_prod_fim']);
        $preco_inicio = floatval($dados['preco_inicio']);
        $preco_fim = floatval($dados['preco_fim']);

        isset($dados['ativo']) ? $ativo = $dados['ativo'] : $ativo = 'false';
        isset($dados['inativo']) ? $inativo = $dados['inativo'] : $inativo = 'false';

        if (($ativo == 'true' && $inativo == 'true') || ($ativo == false && $inativo == 'false')) {
            $query = ' and ativo in (0,1) ';
        } else if ($ativo == 'true' && $inativo == 'false') {
            $query = ' and ativo in (1) ';
        } else if ($ativo == 'false' && $inativo == 'true') {
            $query = ' and ativo in (0)';
        }

        $registros = DB::select('select
            id_produto,
            descricao,
            estoque,
            reservado,
            total_estoque,
            unidade,
            preco,
            valor_total,
            ativo
        from vw_estoque
        where
            id_produto between :cod_prod_inicio and :cod_prod_fim
        and
            preco between :preco_inicio and :preco_fim' . $query, [
            'cod_prod_inicio' => $cod_prod_inicio,
            'cod_prod_fim' => $cod_prod_fim,
            'preco_inicio' => $preco_inicio,
            'preco_fim' => $preco_fim
        ]);

        $data = [
            'cod_prod_inicio' => $cod_prod_inicio,
            'cod_prod_fim' => $cod_prod_fim,
            'preco_inicio' => $preco_inicio,
            'preco_fim' => $preco_fim,
            'registros' => $registros
        ];

        //dd($registros);

        $pdf = PDF::loadView('admin.produto.relatorioestoquepdf', $data)->setPaper('A4', 'landscape');

        // return view('admin.caixa.relatoriocaixaretorno', compact('registros'));
        return $pdf->download('relatorio_estoque.pdf');
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

            isset($dados['ativo']) ? ($dados['ativo'] == true ? 1 : 0) : 0;
            if (isset($dados['ativo']) && $dados['ativo'] == 'true') {
                $dados['ativo'] = 1;
            } else {
                $dados['ativo'] = 0;
            }

            // dd($dados);
            Produto::where('produtos.id_produto', $id_produto)->update($dados);
            // return redirect()->route('admin.produtos');
            return back()->with('success', 'Item atualizado com sucesso.');
        };
    }

    public function inserir(Request $request)
    {
        if (empty($request->descricao)) {
            return response()->json(['msg' => '<div class="alert alert-danger">O campo descrição é obrigatório.</div>', 'tipo' => 'false']);
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
                return response()->json(['msg' => '<div class="alert alert-danger">Erro técnico ao inserir ' . $th->getMessage() . '</div>', 'tipo' => 'false']);
            }
        }
    }
}
