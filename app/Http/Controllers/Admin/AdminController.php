<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $dashboard = DB::table('vw_dashboard_one')->first();


        //dd($pieChart);
        return view('admin.index', compact('dashboard'));
    }
}
