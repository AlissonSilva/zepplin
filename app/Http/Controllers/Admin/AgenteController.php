<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\model\admin\Agente;
use App\model\admin\Banco;
use Illuminate\Http\Request;

class AgenteController extends Controller
{
    public function index()
    {
        $registros = Agente::join('bancos', 'agentes.id_banco', '=', 'bancos.id_banco')->get();
        return view('admin.agente.index', compact('registros'));
    }

    public function adicionar()
    {
        $bancos = Banco::all();
        return view('admin.agente.adicionar', compact('bancos'));
    }

    public function inserir(Request $request){
        //
    }
}
