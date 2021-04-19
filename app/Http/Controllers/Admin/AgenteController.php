<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\model\admin\Agente;
use App\model\admin\Banco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgenteController extends Controller
{
    public function index()
    {
        //$registros = Agente::join('bancos', 'agentes.id_banco', '=', 'bancos.id_banco')->toSql();
        $registros = Agente::join('bancos', 'agentes.id_banco', '=', 'bancos.id_banco')->get();
        // dd($registros);
        return view('admin.agente.index', compact('registros'));
    }

    public function adicionar()
    {
        $bancos = Banco::all();
        return view('admin.agente.adicionar', compact('bancos'));
    }

    public function inserir(Request $request)
    {
        $dados = $request->all();

        //dd($dados);
        unset($dados['_token']);

        $msg = $this->verificador($dados['codigo']);
        try {
            if ($msg == "true") {
                Agente::create($dados);
                return response()->json(array('msg' => '<div class="alert alert-success" role="alert"> Agente cadastrado com sucesso. </div>', 'tipo' => 'true'));
            } else {
                return response()->json(array('msg' => '<div class="alert alert-warning" role="alert"> Erro: código do agente já cadastrado.</div>', 'tipo' => 'false'));
            }
        } catch (\Throwable $th) {
            return response()->json(array('msg' => '<div class="alert alert-warning" role="alert"> Erro técnico: ' . $th->getMessage() . ' . </div>', 'tipo' => 'false'));
        }
    }

    public function editar($id)
    {
        $registros = Agente::where('id_agente', '=', $id)->first();
        $bancos = Banco::all();
        return view('admin.agente.editar', compact('registros', 'bancos'));
    }

    public function atualizar(Request $request, $id)
    {
        $dados = $request->all();
        unset($dados['_token']);
        unset($dados['_method']);

        $dados['status_agente'] = $dados['status_agente'] == 'true' ? 1 : 0;

        try {
            Agente::where('id_agente', '=', $id)->update($dados);
            return redirect()->route('admin.agentes');
        } catch (\Throwable $th) {
            return response()->json(array('msg' => '<div class="alert alert-warning" role="alert"> Erro técnico: ' . $th->getMessage() . ' . </div>', 'tipo' => 'false'));
        }
    }

    public function verificador($codigo)
    {
        $dados = Agente::where('id_agente', '=', $codigo)->count();
        if ($dados > 0) {
            return 'false';
        } else {
            return 'true';
        }
    }
}
