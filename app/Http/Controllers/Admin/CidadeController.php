<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\admin\Cidade;
use App\model\admin\Estado;

class CidadeController extends Controller
{
    public function index(){
        $registros = Cidade::join('estados','cidades.id_estado','=','estados.id_estado')->get();
        return view('admin.cidade.index',compact('registros'));
    }

    public function editar($id){
        $registros = Cidade::join('estados','cidades.id_estado','=','estados.id_estado')
        ->where('cidades.id_cidade',$id)->first();
        $estados = Estado::all();
        return view('admin.cidade.editar',compact('registros', 'estados'));
    }

    public function adicionar(){
        $estados = Estado::all();
        return view('admin.cidade.adicionar',compact('estados'));
    }


    public function inserir(Request $request){

        $dados = $request->all();

        unset($dados['_token']);
        if(isset($dados['capital'])){
            $dados['capital'] = 1;
        }else{
            $dados['capital'] = 0;
        }
        $msg = $this->verificador($dados);

        if($msg == "true"){
            Cidade::create($dados);
            return response()->json(array('msg'=>'<div class="alert alert-success" role="alert"> Cidade de '.$dados['cidade'].' cadastrada com sucesso. </div>', 'tipo'=>'true'));
        }else{
            return response()->json(array('msg'=>$msg, 'tipo'=>'false'));
        }
    }

    public function atualizar(Request $request, $id_cidade){
        $dados = $request->all();
        unset($dados['_token']);
        unset($dados['_method']);
        if(isset($dados['capital'])){
            $dados['capital'] = 1;
        }else{
            $dados['capital'] = 0;
        }
        Cidade::where('cidades.id_cidade',$id_cidade)->update($dados);
        return redirect()->route('admin.cidades');
    }

    public function deletar($id_cidade){
        $contador = Cidade::join('vw_cadastro', 'cidades.id_cidade', '=', 'vw_cadastro.id_cidade')->where('cidades.id_cidade',$id_cidade)->count();
        if($contador){
            return response()->json(['status'=>'false', 'msg'=>'Exclusão não permitida. Cidade com vinculos, por gentileza, verificar os cadastros.']);
        }else{
            $contador = Cidade::where(['cidades.id_cidade'=>$id_cidade, 'cidades.capital'=>1])->count();
            if($contador){
                return response()->json(['status'=>'false', 'msg'=>'Exclusão não permitida. Cidade com vinculo de capital.']);
            }else{
                Cidade::where('cidades.id_cidade',$id_cidade)->delete();
                return response()->json(['status'=>'true', 'msg'=>'Cidade excluída com sucesso']);
            }
        }

    }

    public function verificador($dados){
        $countCidade = Cidade::where(['cidades.cidade'=>strtoupper($dados['cidade']), 'cidades.id_estado'=>$dados['id_estado']])->count();
        if($countCidade){
            return '<div class="alert alert-warning" role="alert"> Cidade '.$dados['cidade'].' já cadastrada para o estado definido.</di>';
        }else if(!isset($dados['capital'])){
            $countCapital = Cidade::where('cidades.id_estado',$dados['id_estado'])->count();
            if($countCapital){
                return '<div class="alert alert-warning" role="alert"> Já existe uma capital cadastrada para esse estado definido. </div>';
            }
        }else{
            return 'true';
        }
    }
}
