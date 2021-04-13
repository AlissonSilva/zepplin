<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $registros = User::all();
        return view('admin.user.index', compact('registros'));
    }

    public function editar()
    {
        //
    }
}
