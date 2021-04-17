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
        //
    }
}
