<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\admin\Perfil;

class PerfilController extends Controller
{
    public function index(){
        $registros = Perfil::all();
        return view('admin.perfil.index',compact('registros'));
    }

    public function adicionar(){
        return view('admin.perfil.adicionar');
    }

    public function editar($id){
        $registros = Perfil::where('id_perfil', $id)->first();
        return view('admin.perfil.editar', compact('registros'));
    }

    public function atualizar($id, Request $request){
        $dados = $request->all();
        unset($dados['_token']);
        unset($dados['_method']);
        
        if(!isset($dados['ativo'])){
            $dados['ativo']=0;
        }else{
            $dados['ativo']=1;
        }
        if(!isset($dados['admin'])){
            $dados['admin']=0;
        }else{
            $dados['admin']=1;
        }
        
        try {
            Perfil::where('id_perfil',$id)->update($dados);
            return redirect()->route('admin.perfil');
        } catch (\Throwable $e) {
            return response()->json(['status'=>false, 'msg'=>'<div class="alert alert-danger" role="alert"> Erro ao salvar.'.$e->getMessage().' </div>']);
        }
    }

    public function deletar($id){
        $contador = Perfil::join('users','perfils.id_perfil','=','users.id_perfil')->where('perfils.id_perfil',$id)->count();
        if($contador){
            return response()->json(['status'=>false, 'msg'=>'Exclusão não permitida. Perfil com vínculos.']);
        }else{
            Perfil::where('perfils.id_perfil',$id)->delete();
            return response()->json(['status'=>true, 'msg'=>'Perfil excluído com sucesso.']);
        }
    }

    public function inserir(Request $request){
        $dados = $request->all();
        unset($dados['_token']);
        
        if($dados['ativo']=='false'){
            $dados['ativo']=0;
        }else{
            $dados['ativo']=1;
        }
        if($dados['admin']=='false'){
            $dados['admin']=0;
        }else{
            $dados['admin']=1;
        }

        if($this->verificarPerfil($dados)){
            try {
                Perfil::create($dados);
                return response()->json(['status'=>true, 'msg'=>'<div class="alert alert-success" role="alert"> Perfil cadastrado com sucesso. </div>']);
            } catch (\Throwable $e) {
                return response()->json(['status'=>false, 'msg'=>'<div class="alert alert-danger" role="alert"> Erro ao salvar.'.$e->getMessage().' </div>']);
            }
        }else{
            return response()->json(['status'=>false, 'msg'=>'<div class="alert alert-danger" role="alert"> Perfil já cadastrado.</div>']);
        }
    }

    public function verificarPerfil($perfil){
        $dados = Perfil::where('descricao',$perfil['descricao'])->count();
        if($dados > 0){
            return false;
        }else{
            return true;
        }

    }
}
