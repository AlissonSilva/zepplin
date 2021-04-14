<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\model\admin\Veiculo;
use App\model\admin\Cliente;

class VeiculoController extends Controller
{

    public function index($id_cliente = null)
    {

        $registros = Veiculo::join('clientes', 'veiculos.id_cliente', '=', 'clientes.id_cliente')
            ->where('veiculos.id_cliente', '=', $id_cliente)->get();

        $cliente = Cliente::leftJoin('pessoa_fisicas', 'clientes.id_pessoa_fisica', '=', 'pessoa_fisicas.id_pessoa_fisica')
            ->leftJoin('pessoa_juridicas', 'clientes.id_pessoa_juridica', '=', 'pessoa_juridicas.id_pessoa_juridica')
            ->where('clientes.id_cliente', '=', $id_cliente)->first();

        // dd($registros);

        // dd($cliente);

        return view('admin.veiculo.index', compact('registros', 'cliente'));
    }

    public function editar($id_cliente, $id){
        $registros = DB::table('veiculos')->join('vw_clientes','veiculos.id_cliente','=','vw_clientes.id_cliente')
        ->where(['veiculos.id_veiculo'=>$id, 'veiculos.id_cliente'=>$id_cliente])->first();

        return view('admin.veiculo.editar', compact('registros'));
    }

    public function atualizar(Request $request){
        dd($request);
    }

    public function listarVeiculosCliente($id_pessoa)
    {
        $registros = Veiculo::join('clientes', 'veiculos.id_cliente', '=', 'clientes.id_cliente')
            ->where('veiculos.id_cliente', $id_pessoa)->first();
        return view('admin.servico.editar', compact('registros'));
    }

    public function inserir(Request $request)
    {
        $dados = $request->all();
        unset($dados['_token']);

        try {
            Veiculo::create($dados);
            return response()->json(['msg' => '<div class="alert alert-success">Veículo cadastrado com sucesso.</div>']);
        } catch (\Throwable $e) {
            return response()->json(['msg' => '<div class="alert alert-danger" role="alert"> Erro ao salvar o cadastro. ' . $e->getMessage() . ' </div>']);;
        }

    }
}
