<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\admin\Banco;
use Illuminate\Support\Facades\DB;


class BancoController extends Controller
{
    public function index()
    {
        $registros = Banco::all();
        return view('admin.banco.index', compact('registros'));
    }

    public function adicionar()
    {
        return view('admin.banco.adicionar');
    }

    public function editar($id)
    {
        $registros = DB::table('bancos')->where('id_banco', '=', $id)->first();
        return view('admin.banco.editar', compact('registros'));
    }

    public function atualizar(Request $request, $id)
    {
        $dados = $request->all();
        unset($dados['_token']);
        unset($dados['_method']);

        if ($this->verificador($dados['codigo_banco'])) {
            $obj = collect([
                'descricao' => $dados['descricao_banco']
            ])->toArray();
        } else {
            $obj = collect([
                'codigo' => $dados['codigo_banco'],
                'descricao' => $dados['descricao_banco']
            ])->toArray();
        }

        Banco::where('bancos.id_banco', $id)->update($obj);
        return redirect()->route('admin.bancos');
    }

    public function inserir(Request $request)
    {
        $dados = $request->all();

        unset($dados['_token']);

        $msg = $this->verificador($dados['codigo']);

        try {

            if ($msg == "true") {
                Banco::create($dados);
                return response()->json(array('msg' => '<div class="alert alert-success" role="alert"> Banco cadastrado com sucesso. </div>', 'tipo' => 'true'));
            } else {
                return response()->json(array('msg' => '<div class="alert alert-warning" role="alert"> Erro: código do banco já cadastrado . </div>', 'tipo' => 'false'));
            }
        } catch (\Throwable $th) {
            return response()->json(array('msg' => '<div class="alert alert-warning" role="alert"> Erro técnico: ' . $th->getMessage() . ' . </div>', 'tipo' => 'false'));
        }
    }

    public function verificador($codigo)
    {
        $dados = DB::table('bancos')->where('bancos.codigo', '=', $codigo)->count();
        if ($dados == 0) {
            return true;
        } else {
            return false;
        }
    }
}
