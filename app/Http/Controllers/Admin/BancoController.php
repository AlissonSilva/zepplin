<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\admin\Banco;

class BancoController extends Controller
{
    public function index(){
        $registros = Banco::all();
        return view('admin.banco.index', compact('registros'));
    }

    public function adicionar(){
        return view('admin.banco.adicionar');
    }

    public function inserir(Request $request){
        $dados = $request->all();

        unset($dados['_token']);

        $msg = $this->verificador($dados);

        if($msg == "true"){
            Banco::create($dados);
            return response()->json(array('msg'=>'<div class="alert alert-success" role="alert"> Banco cadastrado com sucesso. </div>', 'tipo'=>'true'));
        }else{
            return response()->json(array('msg'=>$msg, 'tipo'=>'false'));
        }
    }
}
