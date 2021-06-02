<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\model\admin\Cobranca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaixaController extends Controller
{
    public function index()
    {
        $registros = DB::table('vw_cobranca')->where('status_pagamento', '=', 'aberto')->get();
        $caixa = DB::table('cobrancas')
            ->join('caixa_cobranca','cobrancas.id_cobranca','=' ,'caixa_cobranca.id_cobranca')
            ->join('caixas','caixa_cobranca.id_caixa','=','caixas.id_caixa')
            ->select(DB::raw('sum(valor_parcela) as vl_recebido'))
            ->where('caixas.id_user','=',auth()->user()->id)
            ->where('caixas.data_recebimento', '=', DB::raw('cast(now() as date )'))
            ->where('cobrancas.status_pagamento', '=', 'baixado')
            ->first();
        return view('admin.caixa.index', compact('registros', 'caixa'));
    }

    public function relatorio(){
        return view('admin.caixa.relatoriocaixa');
    }

    public function recebimento(Request $request)
    {
        $dados = $request->all();
        $id_caixa = 0;
        $id_user = auth()->user()->id;

        try {
            Cobranca::whereIn('id_cobranca', $dados['arrayChk'])->update(['status_pagamento' => 'baixado', 'data_pagamento' => DB::raw('CURRENT_TIMESTAMP(0)'), 'data_recebimento' => DB::raw('CURRENT_TIMESTAMP(0)')]);
            $id_caixa = $this->verificarCaixa($id_user);

            foreach ($dados['arrayChk'] as $obj) {
                DB::table('caixa_cobranca')->insert([
                    'id_caixa' => $id_caixa,
                    'id_cobranca' => $obj,
                    'data_recebimento' => now()->toDateString()
                ]);
            }
            return back()->with('success', 'Valor recebido com sucesso!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function verificarCaixa($id_user)
    {
        $data_atual = now()->toDateString();

        $retorno_caixa = DB::table('caixas')
            ->where('id_user', '=', $id_user)
            ->where('data_recebimento', '=', $data_atual)->count();

        $id_caixa = 0;

        if ($retorno_caixa > 0) {
            $id_caixa = DB::table('caixas')
                ->select('id_caixa')
                ->where('id_user', '=', $id_user)
                ->where('data_recebimento', '=', $data_atual)->first();
            $id_caixa = $id_caixa->id_caixa;
        } else {
            $id_caixa = DB::table('caixas')->insertGetId([
                'id_user' => $id_user,
                'data_recebimento' => $data_atual
            ]);
        }
        return $id_caixa;
    }

    public function gerador(Request $request){
        $dados = $request->all();

        // dd($dados);

        $registros = DB::select('select 
        c.id_caixa,
        c.valor_recebido,
        c.id_user,
        cc.data_recebimento
        from caixa_cobranca cc 
        inner join caixas c on c.id_caixa = cc.id_caixa 
        inner join cobrancas c2 on cc.id_cobranca = c2.id_cobranca
        inner join users u2  on c.id_user = u2.id 
        where c.id_user between :cod_inicio and :cod_fim and cc.data_recebimento between :datainicio and :datafim ',
        [
            'cod_inicio'=>intval($dados['cod_user_inicio']),'cod_fim'=>intval($dados['cod_user_fim']), 
            'datainicio'=>$dados['data-inicio'], 'datafim'=>$dados['data-fim']
        ]
    )->groupBy('data_recebimento');

    return view('admin.caixa.relatoriocaixaretorno',compact('registros'));
    }

    public function baixa($id_cobranca)
    {
        Cobranca::where('id_cobranca', '=', $id_cobranca)->each->update(['status_pagamento' => 'baixado']);
    }
}
