<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\model\admin\Orcamento;
use App\model\admin\OrdemServico;
class OrdemServicoController extends Controller
{
    public function index(){
        $registros = DB::table('vw_ordem_servico')->get();
        return view('admin.ordemservico.index', compact('registros'));
    }

    public function adicionar($id_orcamento){
        $dados = DB::table('vw_ordem_servico')
                    ->where('id_orcamento','=',$id_orcamento)
                    ->first();

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
            return redirect(route('admin.ordemservico.form', $idOS));
            //dd($idOS);
        } catch (\Throwable $th) {
            return response()->json(['msg' => '<div class="alert alert-danger" role="alert"> Erro ao salvar o cadastro. ' . $th->getMessage() . ' </div>']);
        }

    }

    public function formulario($id){
        $registros = OrdemServico::join('orcamentos','ordem_servicos.id_orcamento','=','orcamentos.id_orcamento')
        ->join('vw_clientes', 'orcamentos.id_cliente','=','vw_clientes.id_cliente')
        ->where('ordem_servicos.id_ordemservico','=',$id)
        ->first();
        return view('admin.ordemservico.formulario',compact('registros'));
    }
}
