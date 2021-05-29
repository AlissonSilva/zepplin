<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\model\admin\Perfil;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $registros = User::leftJoin('perfils', 'users.id_perfil', '=', 'perfils.id_perfil')->get();
        return view('admin.user.index', compact('registros'));
    }

    public function editar($id)
    {
        $registros = User::where('users.id', '=', $id)->first();
        $perfil = Perfil::all();
        return view('admin.user.editar', compact('registros', 'perfil'));
    }

    public function adicionar()
    {
        $perfil = Perfil::all();
        return view('admin.user.adicionar', compact('perfil'));
    }

    public function inserir(Request $request)
    {
        if (empty($request->name)) {
            return response()->json(['msg' => '<div class="alert alert-danger"> O campo nome é obrigatório.</div>', 'tipo' => 'false']);
        } else if (empty($request->email)) {
            return response()->json(['msg' => '<div class="alert alert-danger">O campo e-mail é obrigatório.</div>', 'tipo' => 'false']);
        } else if (empty($request->password)) {
            return response()->json(['msg' => '<div class="alert alert-danger">O campo senha é obrigatório.</div>', 'tipo' => 'false']);
        } else if ($this->verificarEmail($request->email, 0) > 0) {
            return response()->json(['msg' => '<div class="alert alert-danger">E-mail já cadastrado para um usuário.</div>', 'tipo' => 'false']);
        } else {
            try {
                $obj = collect(
                    [
                        'name' => $request->name,
                        'email' => strtolower($request->email),
                        'password' => bcrypt($request->password),
                        'ativo' => $request->ativo,
                        'cod_cadastro' => 'CF0001',
                        'id_perfil' => $request->perfil
                    ]
                )->toArray();
                User::create($obj);
                return response()->json(['msg' => '<div class="alert alert-success">Usuário cadastro com sucesso</div>', 'tipo' => 'true']);
            } catch (\Throwable $th) {
                return response()->json(['msg' => '<div class="alert alert-dange">Erro ao inserir o usuário no banco ' . $th->getMessage() . '.</div>', 'tipo' => 'false']);
            }
        }
    }

    public function atualizar(Request $request, $id)
    {
        $ativo = $request->ativo == 'true' ? 1 : 0;
        $foto = null;

        if (empty($request->name)) {
            return response()->json(['msg' => '<div class="alert alert-danger"> O campo nome é obrigatório.</div>', 'tipo' => 'false']);
        } else if (empty($request->email)) {
            return response()->json(['msg' => '<div class="alert alert-danger">O campo e-mail é obrigatório.</div>', 'tipo' => 'false']);
        } else if ($this->verificarEmail($request->email, $id) > 0) {
            return response()->json(['msg' => '<div class="alert alert-danger">E-mail já cadastrado para um usuário.</div>', 'tipo' => 'false']);
        } else {
            if($request->hasFile('foto')){
                $imagem = $request->file('foto');
                $num = rand(1111,9999);
                $dir = "img/perfil/";
                $ex = $imagem->guessClientExtension();
                $nomeImagem = "imagem_".$num.".".$ex;
                $imagem->move($dir, $nomeImagem);
                $foto = $dir."/".$nomeImagem;

            }
            if (!empty($request->password)) {
                $obj = collect(
                    [
                        'name' => $request->name,
                        'email' => strtolower($request->email),
                        'password' => bcrypt($request->password),
                        'ativo' => $ativo,
                        'id_perfil' => $request->perfil,
                        'updated_at' => now()->toDateTimeString(),
                        'foto' =>  $foto
                    ]
                )->toArray();
            } else {
                $obj = collect(
                    [
                        'name' => $request->name,
                        'email' => strtolower($request->email),
                        'ativo' =>  $ativo,
                        'id_perfil' => $request->perfil,
                        'updated_at' => now()->toDateTimeString(),
                        'foto' =>  $foto
                    ]
                )->toArray();
            }
            try {
                //dd($obj);
                User::where('id', $id)->update($obj);
                // return response()->json(['msg' => '<div class="alert alert-success">Usuário atualizado com sucesso.</div>', 'tipo' => 'true']);

                // return redirect()->route('admin.user');
                return back()->with('success','Usuário atualizado com sucesso!');
                

            } catch (\Throwable $th) {
                return response()->json(['msg' => '<div class="alert alert-danger">Erro ao atualizar o cadastro do usuário.' . $th->getMessage() . '.</div>', 'tipo' => 'false']);
            }
        }
    }

    public function verificarEmail($email, $pd)
    {
        // $pd = 0 Insert; $pd = 2 Update
        $dados = DB::table('users')->where('users.email', '=', $email)->count();
        if ($pd == 0) {
            return $dados;
        } else {
            $dados = DB::table('users')->where('users.email', '=', $email)->first();
            return $dados->id == $pd ? 0 : $this->verificarEmail($email, 0);
        }
    }
}
