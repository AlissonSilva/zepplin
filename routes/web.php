<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', ['as' => 'site.home', 'uses' => 'Site\HomeController@index']);

Route::get('/login', ['as' => 'login', 'uses' => 'Site\LoginController@index']);
Route::post('/login/entrar', ['as' => 'site.login.entrar', 'uses' => 'Site\LoginController@entrar']);


// Grupo de rotas administrativas
Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin/login/sair', ['as' => 'site.login.sair', 'uses' => 'Site\LoginController@sair']);
    Route::get('/admin', ['as' => 'admin.home', 'uses' => 'Admin\AdminController@index']);
    // Rotas referente aos estados
    Route::get('/admin/estados', ['as' => 'admin.estados', 'uses' => 'Admin\EstadoController@index']);
    Route::get('/admin/estados/{uf}', ['as' => 'admin.estados.visualizar', 'uses' => 'Admin\EstadoController@visualizar']);
    Route::get('/admin/estados/visualizarmunicipios/{id}', ['as' => 'admin.estados.visualizarmunicipios', 'uses' => 'Admin\EstadoController@visualizarmunicipios'])->where('id', '[0-9]+');

    // Rotas referente as cidades
    Route::get('/admin/cidades', ['as' => 'admin.cidades', 'uses' => 'Admin\CidadeController@index']);
    Route::get('/admin/cidades/adicionar', ['as' => 'admin.cidades.adicionar', 'uses' => 'Admin\CidadeController@adicionar']);
    Route::get('/admin/cidades/editar/{id}', ['as' => 'admin.cidades.editar', 'uses' => 'Admin\CidadeController@editar'])->where('id', '[0-9]+');
    Route::put('/admin/cidades/atualizar/{id}', ['as' => 'admin.cidades.atualizar', 'uses' => 'Admin\CidadeController@atualizar'])->where('id', '[0-9]+');
    Route::post('/admin/cidades/inserir', ['as' => 'admin.cidades.inserir', 'uses' => 'Admin\CidadeController@inserir']);
    Route::get('/admin/cidades/deletar/{id}', ['as' => 'admin.cidades.deletar', 'uses' => 'Admin\CidadeController@deletar'])->where('id', '[0-9]+');

    // Rotas referente aos serviços
    Route::get('/admin/servicos', ['as' => 'admin.servicos', 'uses' => 'Admin\ServicoController@index']);
    Route::get('/admin/servicos/adicionar', ['as' => 'admin.servicos.adicionar', 'uses' => 'Admin\ServicoController@adicionar']);
    Route::post('/admin/servicos/inserir', ['as' => 'admin.servicos.inserir', 'uses' => 'Admin\ServicoController@inserir']);
    Route::get('/admin/servicos/editar/{id}', ['as' => 'admin.servicos.editar', 'uses' => 'Admin\ServicoController@editar'])->where('id', '[0-9]+');
    Route::put('/admin/servicos/atualizar/{id}', ['as' => 'admin.servicos.atualizar', 'uses' => 'Admin\ServicoController@atualizar'])->where('id', '[0-9]+');

    // Rotas referente aos produtos
    Route::get('/admin/produtos', ['as' => 'admin.produtos', 'uses' => 'Admin\ProdutoController@index']);
    Route::get('/admin/produtos/adicionar', ['as' => 'admin.produtos.adicionar', 'uses' => 'Admin\ProdutoController@adicionar']);
    Route::post('/admin/produtos/inserir', ['as' => 'admin.produtos.inserir', 'uses' => 'Admin\ProdutoController@inserir']);
    Route::get('/admin/produtos/editar/{id_produto}', ['as' => 'admin.produtos.editar', 'uses' => 'Admin\ProdutoController@editar'])->where('id', '[0-9]+');
    Route::put('/admin/produtos/atualizar/{id_produto}', ['as' => 'admin.produtos.atualizar', 'uses' => 'Admin\ProdutoController@atualizar'])->where('id', '[0-9]+');

    // Rotas referente ao cadastro de pessoas fisicas
    Route::get('/admin/pessoafisica', ['as' => 'admin.pessoafisica', 'uses' => 'Admin\PessoaFisicaController@index']);
    Route::get('/admin/pessoafisica/cadastro', ['as' => 'admin.pessoafisica.adicionar', 'uses' => 'Admin\PessoaFisicaController@adicionar']);
    Route::post('/admin/pessoafisica/inserir', ['as' => 'admin.pessoafisica.inserir', 'uses' => 'Admin\PessoaFisicaController@inserir']);
    Route::get('/admin/pessoafisica/verificarcpfexistente/{cpf}', ['as' => 'admin.pessoafisica.verificarcpfexistente', 'uses' => 'Admin\PessoaFisicaController@verificarCpfExistente']);
    Route::get('/admin/pessoafisica/editar/{id}', ['as' => 'admin.pessoafisica.editar', 'uses' => 'Admin\PessoaFisicaController@editar'])->where('id', '[0-9]+');
    Route::put('/admin/pessoafisica/atualizar/{id}', ['as' => 'admin.pessoafisica.atualizar', 'uses' => 'Admin\PessoaFisicaController@atualizar'])->where('id', '[0-9]+');

    // Rotas referente ao cadastro de pessoas juridicas
    Route::get('/admin/pessoajuridica', ['as' => 'admin.pessoajuridica', 'uses' => 'Admin\PessoaJuridicaController@index']);
    Route::get('/admin/pessoajuridica/adicionar', ['as' => 'admin.pessoajuridica.adicionar', 'uses' => 'Admin\PessoaJuridicaController@adicionar']);
    Route::post('/admin/pessoajuridica/inserir', ['as' => 'admin.pessoajuridica.inserir', 'uses' => 'Admin\PessoaJuridicaController@inserir']);
    Route::get('/admin/pessoajuridica/editar/{id}', ['as' => 'admin.pessoajuridica.editar', 'uses' => 'Admin\PessoaJuridicaController@editar'])->where('id', '[0-9]+');
    Route::put('/admin/pessoajuridica/atualizar/{id}', ['as' => 'admin.pessoajuridica.atualizar', 'uses' => 'Admin\PessoaJuridicaController@atualizar'])->where('id', '[0-9]+');


    // Rotas referente aos perfis
    Route::get('/admin/perfil', ['as' => 'admin.perfil', 'uses' => 'Admin\PerfilController@index']);
    Route::get('/admin/perfil/adicionar', ['as' => 'admin.perfil.adicionar', 'uses' => 'Admin\PerfilController@adicionar']);
    Route::post('/admin/perfil/inserir', ['as' => 'admin.perfil.inserir', 'uses' => 'Admin\PerfilController@inserir']);
    Route::get('/admin/perfil/editar/{id}', ['as' => 'admin.perfil.editar', 'uses' => 'Admin\PerfilController@editar'])->where('id', '[0-9]+');
    Route::put('/admin/perfil/atualizar/{id}', ['as' => 'admin.perfil.atualizar', 'uses' => 'Admin\PerfilController@atualizar'])->where('id', '[0-9]+');
    Route::get('/admin/perfil/deletar/{id}', ['as' => 'admin.perfil.deletar', 'uses' => 'Admin\PerfilController@deletar'])->where('id', '[0-9]+');

    // Rotas veículos
    Route::get('/admin/veiculos/{id_cliente?}', ['as' => 'admin.veiculos', 'uses' => 'Admin\VeiculoController@index'])->where('id', '[0-9]+');
    Route::post('/admin/veiculos/inserir', ['as' => 'admin.veiculos.adicionar', 'uses' => 'Admin\VeiculoController@inserir']);

    // Rotas users
    Route::get('/admin/user/',['as'=> 'admin.user', 'uses'=>'Admin\UserController@index']);
    Route::get('/admin/user/editar/{id}', ['as'=>'admin.user.editar', 'uses'=>'Admin\UserController@editar'])->where('id','[0-9]+');
    Route::get('/admin/user/adicionar/',['as'=>'admin.user.adicionar', 'uses' => 'Admin\UserController@adicionar']);
    Route::put('/admin/user/atualizar/{id}', ['as' => 'admin.user.atualizar', 'uses' => 'Admin\UserController@atualizar'])->where('id','[0-9]+');

    // Orçacamento
    Route::get('/admin/orcamento/', ['as' => 'admin.orcamentos', 'uses' => 'Admin\OrcamentoController@index']);
    Route::get('/admin/orcamento/{id_cliente}', ['as' => 'admin.orcamentos.lista', 'uses' => 'Admin\OrcamentoController@listarOrcamentos'])->where('id_cliente', '[0-9]+');
    Route::get('/admin/orcamento/{id}/novo', ['as' => 'admin.orcamentos.novo', 'uses' => 'Admin\OrcamentoController@novo'])->where('id', '[0-9]+');
    Route::get('/admin/orcamento/{id}/adicionar/{id_orcamento}', ['as' => 'admin.orcamentos.adicionar', 'uses' => 'Admin\OrcamentoController@adicionar'])->where('id', '[0-9]+');
    Route::get('/admin/orcamento/removeritem/{id_orcamento_item}', ['as' => 'admin.orcamentos.removeritem', 'uses' => 'Admin\OrcamentoController@removerItem'])->where('id_orcamento_item', '[0-9]+');
    Route::post('/admin/orcamento/inseriritemorcamento', ['as' => 'admin.orcamentos.inserirItemOrcamento', 'uses' => 'Admin\OrcamentoController@inserirItemOrcamento']);
    Route::post('/admin/orcamento/salvar/', ['as' => 'admin.orcamentos.salvarOrcamento', 'uses' => 'Admin\OrcamentoController@salvarOrcamento']);
    Route::get('/admin/orcamento/printer/{id}', ['as' => 'admin.orcamentos.printer', 'uses' => 'Admin\OrcamentoController@printerOrcamento'])->where('id', '[0-9]+');
    Route::post('/admin/orcamento/aprovar/', ['as' => 'admin.orcamentos.aprovar', 'uses' => 'Admin\OrcamentoController@aprovarOrcamento']);
    Route::post('/admin/orcamento/cancelar/', ['as' => 'admin.orcamentos.cancelar', 'uses' => 'Admin\OrcamentoController@cancelarOrcamento']);
});
