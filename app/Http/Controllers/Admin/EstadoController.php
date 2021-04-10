<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\admin\Estado;
use App\model\admin\Cidade;

class EstadoController extends Controller
{
    public function index(){
        $registros = Estado::all();
        return view('admin.estado.index',compact('registros'));
    }

    public function cadastrar(){
        //
    }

    public function alterar(Request $request, $id){
        //
    }

    public function visualizarMunicipios($id){
        $municipios = Cidade::leftJoin('estados','cidades.id_estado','=','estados.id_estado')
        ->where('estados.id_estado',$id)->get();
        return $municipios;
    }

    public function visualizar($uf){
        $registro = Estado::leftJoin('cidades','estados.id_estado','=','cidades.id_estado')
        ->where(['estados.uf'=>$uf, 'cidades.capital'=>true])
        ->limit(1)
        ->first();

        $municipios = Cidade::leftJoin('estados','cidades.id_estado','=','estados.id_estado')
        ->where('estados.uf',$uf)->get();

        return view('admin.estado.estado',compact('registro','municipios'));
    }



}
