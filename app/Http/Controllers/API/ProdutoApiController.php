<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\model\admin\Produto;
use Illuminate\Support\Facades\DB;

class ProdutoApiController extends Controller
{

    public function getProdutoAutoComplete(Request $request)
    {
        if ($request->has('term')) {
            return DB::table('vw_itens')->where('vw_itens.descricao', 'like', '%' . $request->input('term') . '%')->get();
            // return Produto::where('produtos.descricao', 'like', '%'. $request->input('term') . '%')->get();
        }
    }
}
