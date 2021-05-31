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

    public function baixa($id_cobranca)
    {
        Cobranca::where('id_cobranca', '=', $id_cobranca)->each->update(['status_pagamento' => 'baixado']);
    }
}
