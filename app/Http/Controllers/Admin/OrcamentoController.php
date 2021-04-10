<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\admin\Orcamento;
use App\model\admin\OrcamentoItem;
use App\model\admin\Cliente;
use App\model\admin\Veiculo;
use App\User;
use PhpParser\Node\Stmt\TryCatch;

class OrcamentoController extends Controller
{
    public function index()
    {
        $registros = Cliente::join('vw_clientes', 'clientes.id_cliente', '=', 'vw_clientes.id_cliente')->get();
        return view('admin.orcamento.index', compact('registros'));
    }

    public function listarOrcamentos($id_cliente)
    {
        $registros = Orcamento::where('id_cliente', '=', $id_cliente)->get();
        return view('admin.orcamento.listarorcamento', compact('registros'));
    }

    public function adicionar($id, $id_orcamento)
    {
        $tabelaItem = '';
        $orcamento = '';
        $registros = Cliente::join('vw_clientes', 'clientes.id_cliente', '=', 'vw_clientes.id_cliente')->where('vw_clientes.id_cliente', '=', $id)->first();
        $veiculos = Veiculo::where('veiculos.id_cliente', '=', $id)->get();

        if (isset($id_orcamento)) {
            $orcamento = Orcamento::where('orcamentos.id_orcamento', '=', $id_orcamento)->first();
            $tabelaItem = collect(['tabela' => $this->tabelaItemOrcamento($id_orcamento)])->toArray();
        }


        $objOcamento = ['id_orcamento' => $id_orcamento];

        return view('admin.orcamento.adicionar', compact('registros', 'veiculos', 'objOcamento', 'orcamento', 'tabelaItem'));
    }

    public function novo($id)
    {
        $registros = Cliente::join('vw_clientes', 'clientes.id_cliente', '=', 'vw_clientes.id_cliente')->where('vw_clientes.id_cliente', '=', $id)->first();
        $veiculos = Veiculo::where('veiculos.id_cliente', '=', $id)->get();
        $objOcamento = collect([
            'valor_desconto' => 0,
            'percentual_desconto' => 0,
            'valor_total_sem_desconto' => 0,
            'valor_total' => 0,
            'status_orcamento' => 'aberto',
            'id_cliente' => $registros['id_cliente'],
            'id_user' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ])->toArray();

        try {
            $idOrcamento = Orcamento::insertGetId($objOcamento);
            // return view('admin.orcamento.adicionar', ['id_orcamento' => $idOrcamento], compact('registros', 'veiculos'));
            return redirect(route('admin.orcamentos.adicionar', ['id' => $id, 'id_orcamento' => $idOrcamento]));
        } catch (\Throwable $th) {
            return response()->json(['msg' => '<div class="alert alert-danger" role="alert"> Erro ao salvar o cadastro. ' . $th->getMessage() . ' </div>',]);;
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     *
     */
    public function inserirItemOrcamento(Request $request)
    {
        $registros = $request->all();
        $objOcamento = '';
        $objOcamentoItem = '';

        // dd($registros);

        $objOcamento = collect([
            'id_veiculo' => $registros['id_veiculo']
        ])->toArray();

        try {
            Orcamento::where('id_orcamento', $registros['id_orcamento'])->update($objOcamento);
        } catch (\Throwable $e) {
            return response()->json(['tabela' => '<div class="alert alert-danger" role="alert"> Erro ao atualizar o veículo . ' . $e->getMessage() . ' </div>',]);
        }

        $identificador = $registros['tipo'] == 'servico' ? 'id_servico' : 'id_produto';

        $objOcamentoItem = collect([
            'id_orcamento' => $registros['id_orcamento'],
            $identificador => $registros['id_produto'],
            'valor_desconto' => $registros['valor_desconto'],
            'percentual_desconto' => $registros['percentual_desconto'],
            'valor_total_sem_desconto' => ($registros['valor_unitario'] * $registros['quantidade']),
            'quantidade' => $registros['quantidade'],
            'valor_total' => $registros['valor_total'],
            'id_user' => $registros['id_user']
        ])->toArray();

        // dd($objOcamentoItem);

        try {
            OrcamentoItem::create($objOcamentoItem);
            $dadosOrcamento = $this->dadosOrcamento($registros['id_orcamento']);

            // dd($dadosOrcamento);
            return response()->json([
                'tabela' => '
                <table class="table-active table table-bordered" id="resultado_itemorcamento">
                        <thead>
                            <tr>
                                <th>Cód. Item</th>
                                <th>Desc</th>
                                <th>Qtd</th>
                                <th>Valor Unid.</th>
                                <th>% Desc.</th>
                                <th>Valor Desc.</th>
                                <th>Valor Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            ' . $this->tabelaItemOrcamento($registros['id_orcamento']) . '
                        </tbody>

                    </table>', 'valor_total_sem_desconto' => $dadosOrcamento['valor_total_sem_desconto'], 'valor_desconto' => $dadosOrcamento['valor_desconto'], 'valor_total' => $dadosOrcamento['valor_total']
            ]);
        } catch (\Throwable $e) {
            return response()->json(['tabela' => '<div class="alert alert-danger" role="alert"> Erro ao inserir item . ' . $e->getMessage() . ' </div>',]);
        }
    }

    public function dadosOrcamento($id_orcamento)
    {
        $dados = Orcamento::where('id_orcamento', '=', $id_orcamento)->first();
        return $dados;
    }

    public function salvarOrcamento(Request $request)
    {
        $dados = $request->all();

        $obj = collect([
            'salvo' => 1,
        ])->toArray();

        try {
            Orcamento::where('id_orcamento', $dados['id_orcamento'])->update($obj);
            return back();
        } catch (\Throwable $th) {
            return response()->json(['tabela' => '<div class="alert alert-danger" role="alert"> Salvar o orçamento . ' . $th->getMessage() . ' </div>',]);
        }
    }

    public function printerOrcamento($id)
    {
        $dados = Orcamento::join('vw_item_orcamento', 'orcamentos.id_orcamento', '=', 'vw_item_orcamento.id_orcamento')
            ->where('orcamentos.id_orcamento', '=', $id)->get();

        $orcamento = Orcamento::join('vw_clientes', 'orcamentos.id_cliente', '=', 'vw_clientes.id_cliente')
            ->join('vw_orcamento_qtd_item', 'orcamentos.id_orcamento', '=', 'vw_orcamento_qtd_item.id_orcamento')
            ->where('orcamentos.id_orcamento', '=', $id)->first();
        return view('admin.orcamento.orcamento_print', compact('orcamento', 'dados'));
    }

    public function tabelaItemOrcamento($id_orcamento)
    {
        $retorno = '';
        $dados = Orcamento::join('vw_item_orcamento', 'orcamentos.id_orcamento', '=', 'vw_item_orcamento.id_orcamento')
            ->where('orcamentos.id_orcamento', '=', $id_orcamento)->get();
        foreach ($dados as $valor) {
            $retorno .= '<tr>
                <td>' . $valor['cod_item'] . '</td>
                <td>' . $valor['descricao'] . '</td>
                <td>' . $valor['quantidade'] . '</td>
                <td>' . $valor['valor_unitario'] . '</td>
                <td>' . $valor['percentual_desconto'] . '</td>
                <td>' . $valor['valor_desconto'] . '</td>
                <td>' . $valor['valor_total'] . '</td>';
            if ($valor['status_orcamento'] != 'aberto') {
                $retorno .= '<td></td>';
            } else {
                $retorno .= '<td> <a href="' . route('admin.orcamentos.removeritem', $valor['id_orcamento_item']) . '" class=" btn-circle btn-sm btn-danger " > <i class="fas fa-times"></i> </a> </td>';
            }

            '</tr>';
        }
        return $retorno;
    }

    public function removerItem($id_orcamento_item)
    {
        try {
            OrcamentoItem::where('orcamento_items.id_orcamento_item', $id_orcamento_item)->delete();
            return back();
        } catch (\Throwable $th) {
            response()->json(['tabela' => '<div class="alert alert-danger" role="alert"> Erro ao remover item . ' . $th->getMessage() . ' </div>',]);
        }
    }

    public function aprovarOrcamento(Request $request)
    {
        $dados = $request->all();

        $obj = collect([
            'status_orcamento' => 'aprovado',
        ])->toArray();

        try {
            Orcamento::where('id_orcamento', $dados['id_orcamento'])->update($obj);
            return back();
        } catch (\Throwable $th) {
            return response()->json(['tabela' => '<div class="alert alert-danger" role="alert"> Erro ao aprovar orçamento . ' . $th->getMessage() . ' </div>',]);
        }
    }

    public function cancelarOrcamento(Request $request)
    {

        $dados = $request->all();

        $obj = collect([
            'status_orcamento' => 'cancelado',
        ])->toArray();

        try {
            Orcamento::where('id_orcamento', $dados['id_orcamento'])->update($obj);
            return back();
        } catch (\Throwable $th) {
            return response()->json(['tabela' => '<div class="alert alert-danger" role="alert"> Erro ao cancelar orçamento . ' . $th->getMessage() . ' </div>',]);
        }
    }
}
