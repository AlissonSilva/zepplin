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
        try {
            Cobranca::whereIn('id_cobranca', $dados['arrayChk'])->update(['status_pagamento' => 'baixado', 'data_pagamento' => DB::raw('CURRENT_TIMESTAMP(0)'), 'data_recebimento' => DB::raw('CURRENT_TIMESTAMP(0)')]);
            return back()->with('success', 'Valor recebido com sucesso!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function baixa($id_cobranca)
    {
        Cobranca::where('id_cobranca', '=', $id_cobranca)->each->update(['status_pagamento' => 'baixado']);
    }
}
