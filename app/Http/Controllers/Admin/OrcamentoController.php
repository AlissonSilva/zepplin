<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\model\admin\Agente;
use Illuminate\Http\Request;
use App\model\admin\Orcamento;
use App\model\admin\OrcamentoItem;
use App\model\admin\Cliente;
use App\model\admin\OrcamentoPagamento;
use App\model\admin\Pagamento;
use App\model\admin\Veiculo;
use App\User;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;
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

    public function pagOrcamento(Request $request)
    {
        $dados = $request->all();
        // dd($dados);
        $objBanco = DB::table('vw_forma_pagamento')->where('id_pagamento', '=', $dados['id_pagamento'])->first();
        $obj = collect([
            'id_orcamento' => intval($dados['id_orcamento']),
            'id_agente' => $objBanco->id_agente,
            'id_pagamento' => $objBanco->id_pagamento,
            'id_banco' => $objBanco->id_banco,
            'parcelas' => intval($dados['parcela']),
            'valor_parcela' => doubleval($dados['valor'] / $dados['parcela']),
            'valor_total' => doubleval($dados['valor'])
        ])->toArray();
        try {
            OrcamentoPagamento::create($obj);

            $consolidador = DB::table('vw_orcamento_pagamento_consolidado')->where('id_orcamento', '=', $dados['id_orcamento'])->groupBy('id_orcamento')->first();
            $valor_a_receber = $consolidador->valor_a_receber;
            $valor_recebido = $consolidador->valor_total_recebido;

            return response()->json(['msg' => $this->tabelaPagamento($dados['id_orcamento']), 'tipo' => 'true', 'valor_a_receber' => $valor_a_receber, 'valor_recebido' => $valor_recebido]);
        } catch (\Throwable $th) {
            return response()->json(['msg' => '<div class="alert alert-danger" role="alert"> Erro tecnico: ' . $th->getMessage() . ' </div>', 'tipo' => 'false']);
        }
    }

    public function tabelaPagamento($id_orcamento)
    {
        $dados = OrcamentoPagamento::where('id_orcamento', '=', $id_orcamento)->get();
        $tabela = '<br><table class="table" id="resultado_itemorcamento">
         <thead>
             <tr>
                 <th>Parcelas</th>
                 <th>Valor Parcelas</th>
                 <th>Valor Total</th>
                 <th></th>
             </tr>
         </thead>
         <tbody>';
        foreach ($dados as $obj) {
            $tabela .= '<tr>';
            $tabela .= '<td>' . $obj->parcelas . '</td>';
            $tabela .= '<td>' .  number_format($obj->valor_parcela, 2, ',', '.')  . '</td>';
            $tabela .= '<td>' .  number_format($obj->valor_total, 2, ',', '.')   . '</td>';
            $tabela .= '<td> <a href="' . route('admin.orcamentos.removerPagamento', $obj->id_orcamento_pagamento) . '" class="btn btn-sm btn-outline-danger"> REMOVER</a> </td>';
            $tabela .= '</tr>';
        }
        $tabela .= '</tbody></table>';

        return $tabela;
    }

    public function adicionar($id, $id_orcamento)
    {
        $pagamentos = DB::table('vw_forma_pagamento')->get();

        // dd($pagamentos);
        $tabelaItem = '';
        $orcamento = '';
        $registros = Cliente::join('vw_clientes', 'clientes.id_cliente', '=', 'vw_clientes.id_cliente')->where('vw_clientes.id_cliente', '=', $id)->first();
        $veiculos = Veiculo::where('veiculos.id_cliente', '=', $id)->get();

        if (isset($id_orcamento)) {
            $orcamento = Orcamento::where('orcamentos.id_orcamento', '=', $id_orcamento)->first();
            $tabelaItem = collect(['tabela' => $this->tabelaItemOrcamento($id_orcamento)])->toArray();
        }


        $objOcamento = ['id_orcamento' => $id_orcamento];

        $valorRecebido = OrcamentoPagamento::where('id_orcamento', '=', $id_orcamento)->sum('valor_total');

        $tabelaPag = $this->tabelaPagamento($id_orcamento);

        return view('admin.orcamento.adicionar', compact('registros', 'veiculos', 'objOcamento', 'orcamento', 'tabelaItem', 'pagamentos', 'valorRecebido', 'tabelaPag'));
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
            return response()->json(['msg' => '<div class="alert alert-danger" role="alert"> Erro ao salvar o cadastro. ' . $th->getMessage() . ' </div>']);
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

        $verificadorPagamento = $this->verificarPagamento($registros['id_orcamento']);

        // if ($verificadorPagamento == 'true') {
        //     return response()->json(['tabela' => '<div class="alert alert-danger" role="alert"> Erro ao inserir o item. Verificaras condições de pagamento. Atualizar a página</div>',]);
        // } else {

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

        try {
            OrcamentoItem::create($objOcamentoItem);
            $dadosOrcamento = $this->dadosOrcamento($registros['id_orcamento']);

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
        // }
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
            return response()->json(['tabela' => '<div class="alert alert-danger" role="alert">Salvar o orçamento . ' . $th->getMessage() . ' </div>',]);
        }
    }

    public function printerOrcamento($id)
    {
        $dados = Orcamento::join('vw_item_orcamento', 'orcamentos.id_orcamento', '=', 'vw_item_orcamento.id_orcamento')
            ->where('orcamentos.id_orcamento', '=', $id)->get();

        $orcamento = Orcamento::join('vw_clientes', 'orcamentos.id_cliente', '=', 'vw_clientes.id_cliente')
            ->join('vw_orcamento_qtd_item', 'orcamentos.id_orcamento', '=', 'vw_orcamento_qtd_item.id_orcamento')
            ->where('orcamentos.id_orcamento', '=', $id)->first();

        $formaPagamento = DB::table('vw_orcamento_pagamento')->where('id_orcamento', '=', $id)->get();

        return view('admin.orcamento.orcamento_print', compact('orcamento', 'dados', 'formaPagamento'));
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
                // if ($this->verificarPagamento($id_orcamento)) {
                //     $retorno .= '<td> <a href="#" class=" btn btn-sm btn-outline-danger disabled" > <i class="fas fa-times"></i> </a> </td>';
                // } else {
                //     $retorno .= '<td> <a id="forma_pagamento" href="' . route('admin.orcamentos.removeritem', $valor['id_orcamento_item']) . '" class=" btn btn-sm btn-outline-danger " > <i class="fas fa-times"></i> </a> </td>';
                // }
                $retorno .= '<td> <a id="forma_pagamento" href="' . route('admin.orcamentos.removeritem', $valor['id_orcamento_item']) . '" class=" btn btn-sm btn-outline-danger " > <i class="fas fa-times"></i> </a> </td>';
            }
            '</tr>';
        }
        return $retorno;
    }

    public function pesquisar()
    {
        return view('admin.orcamento.consultaorcamento');
    }

    public function removerPagamento($id)
    {
        try {
            OrcamentoPagamento::where('id_orcamento_pagamento', $id)->delete();
            return back();
        } catch (\Throwable $th) {
            response()->json(['tabela' => '<div class="alert alert-danger" role="alert"> Erro ao remover pagamento . ' . $th->getMessage() . ' </div>',]);
        }
    }

    public function verificarPagamento($id_orcamento)
    {
        $obj = DB::table('orcamento_pagamentos')->count();
        $retorno = $obj > 0 ?  'true' : 'false';
        return $retorno;
    }

    public function validarSaldoPagamento($id_orcamento)
    {
        $obj = DB::table('vw_orcamento_pagamento_consolidado')->where('id_orcamento', '=', $id_orcamento)->sum('valor_a_receber');
        return $obj == 0 ? 'true' : 'false';
    }

    public function removerItem($id_orcamento_item)
    {
        try {
            OrcamentoItem::where('orcamento_items.id_orcamento_item', $id_orcamento_item)->delete();
            return back()->with('success', 'Item removido com sucesso.');
        } catch (\Throwable $th) {
            response()->json(['tabela' => '<div class="alert alert-danger" role="alert"> Erro ao remover item . ' . $th->getMessage() . ' </div>',]);
        }
    }

    public function aprovarOrcamento(Request $request)
    {

        if ($this->validarSaldoPagamento($request['id_orcamento']) == 'true') {
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
        } else {
            return response()->json(['msg' => 'Falha na aprova. Verificar o saldo na forma de pagamento', 'tipo' => 0]);
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
