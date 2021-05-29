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
            ->select(DB::raw('sum(valor_parcela) as vl_recebido'))
            ->where('data_recebimento', '=', DB::raw('cast(now() as date )'))
            ->where('status_pagamento', '=', 'baixado')
            ->first();
        return view('admin.caixa.index', compact('registros', 'caixa'));
    }

    public function recebimento(Request $request)
    {
        $dados = $request->all();
        $id_caixa = 0;
        $id_user = auth()->user()->id;

        try {

            Cobranca::whereIn('id_cobranca', $dados['arrayChk'])->update(['status_pagamento' => 'baixado', 'data_pagamento' => DB::raw('CURRENT_TIMESTAMP(0)'), 'data_recebimento' => DB::raw('CURRENT_TIMESTAMP(0)')]);

            $id_caixa = $this->verificarCaixa($id_user);

            // dd($id_caixa);

            foreach ($dados['arrayChk'] as $obj) {
                DB::table('caixa_cobranca')->insert([
                    'id_caixa' => $id_caixa->id_caixa,
                    'id_cobranca' => $obj,
                    'data_recebimento' => DB::raw('cast(now() as date)')
                ]);
            }

            return back()->with('success', 'Valor recebido com sucesso!');
            //auth()->user()->id,

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function verificarCaixa($id_user)
    {
        // $idOrcamento = Orcamento::insertGetId($objOcamento);
        // $data_atual = DB::select('select cast(now() as date) as data_atual', [1])->first();
        // $data_atual = DB::raw('cast(now() as date) as date_atual');
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
        } else {
            $id_caixa = DB::table('caixas')->insertGetId([
                'id_user' => $id_user,
                'data_recebimento' => DB::raw('cast(now() as date)')
            ]);
        }
        return $id_caixa;
    }

    public function baixa($id_cobranca)
    {
        Cobranca::where('id_cobranca', '=', $id_cobranca)->each->update(['status_pagamento' => 'baixado']);
    }
}
