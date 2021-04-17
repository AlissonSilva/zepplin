<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function entrar(Request $request)
    {
        $dados = $request->all();

        if (Auth::attempt(['email' => $dados['email_login'], 'password' => $dados['senha_login']])) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('site.home');
        }
    }

    public function sair()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
