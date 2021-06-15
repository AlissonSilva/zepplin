<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\model\admin\Orcamento;
use App\model\admin\OrcamentoItem;
use App\model\admin\OrdemServico;
use App\model\admin\OrdemServicoServico;
use App\User;

class OrdemServicoController extends Controller
{
    public function index()
    {
        $registros = DB::table('vw_ordem_servico')->get();
        return view('admin.ordemservico.index', compact('registros'));
    }

    public function adicionar($id_orcamento)
    {
        $dados = DB::table('vw_ordem_servico')
            ->where('id_orcamento', '=', $id_orcamento)
            ->first();

        $servicos = OrcamentoItem::join('servicos', 'orcamento_items.id_servico', 'servicos.id_servico')
            ->where('id_orcamento', '=', $id_orcamento)->get();


        // dd($dados);
        $objOS = collect([
            'id_orcamento' => $dados->id_orcamento,
            'id_cliente' => $dados->id_cliente,
            'prioridade' => 'baixa',
            'status_servico' => 'iniciado',
            'id_veiculo' => $dados->id_veiculo,
            'id_user' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ])->toArray();
        try {
            $idOS = OrdemServico::insertGetId($objOS);
            $objOSS = [];

            //'id_ordemservico', 'id_servico', 'data_hora_inicio', 'data_hora_finalizacao', 'status_servico', 'id_funcionario'
            foreach ($servicos as $rows) {
                $objOSS[] = collect([
                    'id_ordemservico' => $idOS,
                    'id_servico' => $rows['id_servico'],
                    'created_at' => date('Y-m-d H:i:s')
                ])->toArray();
            }

            OrdemServicoServico::insert($objOSS);
            return redirect(route('admin.ordemservico.form', $idOS));
            //dd($idOS);
        } catch (\Throwable $th) {
            return response()->json(['msg' => '<div class="alert alert-danger" role="alert"> Erro ao salvar o cadastro. ' . $th->getMessage() . ' </div>']);
        }
    }

    public function formulario($id)
    {
        $registros = OrdemServico::join('orcamentos', 'ordem_servicos.id_orcamento', '=', 'orcamentos.id_orcamento')
            ->join('vw_clientes', 'orcamentos.id_cliente', '=', 'vw_clientes.id_cliente')
            ->join('veiculos', 'orcamentos.id_veiculo', 'veiculos.id_veiculo')
            ->where('ordem_servicos.id_ordemservico', '=', $id)
            ->first();

        $servicos = OrdemServicoServico::join('servicos', 'ordem_servico_servicos.id_servico', '=', 'servicos.id_servico')
            ->where('id_ordemservico', '=', $id)->get();

        $funcionarios = DB::table('users')->get();

        return view('admin.ordemservico.formulario', compact('registros', 'servicos', 'funcionarios'));
    }
}
