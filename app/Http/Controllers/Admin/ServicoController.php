<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\admin\Servico;

class ServicoController extends Controller
{
    public function index(){
        $registros = Servico::all();
        return view('admin.servico.index',compact('registros'));
    }

    public function adicionar(){

        return view('admin.servico.adicionar');
    }

    public function editar($id){
        $registros = Servico::where('servicos.id_servico',$id)->first();
        return view('admin.servico.editar',compact('registros'));
    }

    public function atualizar(Request $request, $id){

        //dd($request);

        if(empty($request->descricao)){
            return response()->json(['msg'=>'<div class="alert alert-danger"> O campo descrição é obrigatório.</div>', 'tipo'=>'false']);
        }else if(empty($request->preco)){
            return response()->json(['msg'=>'<div class="alert alert-danger">O campo valor é obrigatório.</div>', 'tipo'=>'false']);
        }else{
            $dados = $request->all();
            unset($dados['_token']);
            unset($dados['_method']);

            if(isset($dados['ativo']) && $dados['ativo'] == 'true'){
                $dados['ativo']=1;
            }else {
                $dados['ativo']=0;
            }

            Servico::where('servicos.id_servico',$id)->update($dados);
            return redirect()->route('admin.servicos');
        }

    }

    public function inserir(Request $request){

        if(empty($request->descricao)){
            return response()->json(['msg'=>'<div class="alert alert-danger"> O campo descrição é obrigatório.</div>', 'tipo'=>'false']);
        }else if(empty($request->preco)){
            return response()->json(['msg'=>'<div class="alert alert-danger">O campo valor é obrigatório.</div>', 'tipo'=>'false']);
        }else{
            $dados = $request->all();

            //dd($dados);
            if($dados['ativo'] == 'true'){
                $dados['ativo']=1;
            }else if($dados['ativo']=='false'){
                $dados['ativo']=0;
            }

            //dd($dados);
            Servico::create($dados);
            return response()->json(['msg'=>'<div class="alert alert-success">Serviço cadastrado com sucesso.</div>', 'tipo'=>'true']);
        }


    }
}
