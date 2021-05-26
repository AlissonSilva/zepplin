<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaixaController extends Controller
{
    public function index()
    {

        $registros = DB::table('vw_cobranca')->where('status_pagamento', '=', 'aberto')->get();
        return view('admin.caixa.index', compact('registros'));
    }
}
