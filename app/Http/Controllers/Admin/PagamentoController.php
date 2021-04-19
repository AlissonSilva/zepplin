<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\model\admin\Agente;
use App\model\admin\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    public function index()
    {
        $registros = Pagamento::join('agentes', 'pagamentos.id_agente', '=', 'agentes.id_agente')->get();
        return view('admin.pagamento.index', compact('registros'));
    }

    public function adicionar()
    {
        $agentes = Agente::join('bancos', 'agentes.id_banco', '=', 'bancos.id_banco')->get();
        return view('admin.pagamento.adicionar', compact('agentes'));
    }

    public function editar($id)
    {
        $registros = Pagamento::join('agentes', 'pagamentos.id_agente', '=', 'agentes.id_agente')
            ->where('pagamentos.id_pagamento', '=', $id)
            ->first();
        $agentes = Agente::join('bancos', 'agentes.id_banco', '=', 'bancos.id_banco')->get();
        return view('admin.pagamento.editar', compact('registros', 'agentes'));
    }

    public function atualizar(Request $request, $id)
    {
        $dados = $request->all();
        //dd($dados);
        unset($dados['_token']);
        unset($dados['_method']);
        $dados['status_pagamento'] = $dados['status_pagamento'] == 'true' ? 1 : 0;
        try {
            Pagamento::where('pagamentos.id_pagamento', '=', $id)->update($dados);
            return redirect()->route('admin.pagamentos');
        } catch (\Throwable $th) {
            return response()->json(array('msg' => '<div class="alert alert-warning" role="alert"> Erro técnico: ' . $th->getMessage() . ' . </div>', 'tipo' => 'false'));
        }
    }

    public function inserir(Request $request)
    {
        $dados = $request->all();
        //dd($dados);
        unset($dados['_token']);
        $dados['status_pagamento'] = $dados['status_pagamento'] == 'true' ? 1 : 0;
        try {
            Pagamento::create($dados);
            return response()->json(array('msg' => '<div class="alert alert-success" role="alert"> Forma de pagamento cadastrado com sucesso. </div>', 'tipo' => 'true'));
        } catch (\Throwable $th) {
            return response()->json(array('msg' => '<div class="alert alert-warning" role="alert"> Erro técnico: ' . $th->getMessage() . ' . </div>', 'tipo' => 'false'));
        }
    }
}
