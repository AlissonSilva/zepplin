<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\model\admin\Perfil;

class UserController extends Controller
{
    public function index()
    {
        $registros = User::all();
        return view('admin.user.index', compact('registros'));
    }

    public function editar($id)
    {
        $registros = User::where('users.id','=',$id)->first();
        return view('admin.user.editar', compact('registros'));
    }

    public function adicionar(){
        $perfil = Perfil::all();
        return view('admin.user.adicionar', compact('perfil'));
    }

    public function atualizar(){
        //
    }
}
