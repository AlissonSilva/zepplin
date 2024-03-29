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
Route::get('/login/sair', ['as' => 'site.login.sair', 'uses' => 'Site\LoginController@sair']);


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
    Route::get('/admin/produtos/relatorioestoque/', ['as' => 'admin.produtos.relatorioestoque', 'uses' => 'Admin\ProdutoController@relatorioestoque']);
    Route::post('/admin/produtos/gerarpdf/', ['as' => 'admin.produtos.gerarpdf', 'uses' => 'Admin\ProdutoController@createpdf']);

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
    Route::get('/admin/veiculos/{id_cliente}', ['as' => 'admin.veiculos', 'uses' => 'Admin\VeiculoController@index'])->where('id', '[0-9]+');
    Route::post('/admin/veiculos/inserir', ['as' => 'admin.veiculos.inserir', 'uses' => 'Admin\VeiculoController@inserir']);
    Route::get('/admin/veiculos/{id_cliente}/{id}', ['as' => 'admin.veiculos.editar', 'uses' => 'Admin\VeiculoController@editar'])->where('id', '[0-9]+');
    Route::get('/admin/veiculos/{id_cliente}/adicionar', ['as' => 'admin.veiculos.adicionar', 'uses' => 'Admin\VeiculoController@adicionar'])->where('id_cliente', '[0-9]+');
    Route::put('/admin/veiculos/atualizar/', ['as' => 'admin.veiculos.atualizar', 'uses' => 'Admin\VeiculoController@atualizar']);

    // Rotas users
    Route::get('/admin/user/', ['as' => 'admin.user', 'uses' => 'Admin\UserController@index']);
    Route::get('/admin/user/editar/{id}', ['as' => 'admin.user.editar', 'uses' => 'Admin\UserController@editar'])->where('id', '[0-9]+');
    Route::get('/admin/user/adicionar/', ['as' => 'admin.user.adicionar', 'uses' => 'Admin\UserController@adicionar']);
    Route::put('/admin/user/atualizar/{id}', ['as' => 'admin.user.atualizar', 'uses' => 'Admin\UserController@atualizar'])->where('id', '[0-9]+');
    Route::post('/admin/user/inserir/', ['as' => 'admin.user.inserir', 'uses' => 'Admin\UserController@inserir']);

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
    Route::post('/admin/financeiro/forma_pagamento/pagamento_orcamento', ['as' => 'admin.orcamentos.pagorcamento', 'uses' => 'Admin\OrcamentoController@pagOrcamento']);
    Route::get('/admin/orcament/forma_pagamento/{id}', ['as' => 'admin.orcamentos.tabelaPagamentos', 'uses' => 'Admin\OrcamentoController@tabelaPagamento'])->where('id', '[0-9]+');
    Route::get('/admin/orcamento/removerformapagamento/{id}', ['as' => 'admin.orcamentos.removerPagamento', 'uses' => 'Admin\OrcamentoController@removerPagamento'])->where('id', '[0-9]+');
    Route::get('/admin/orcamento/pesquisar/', ['as' => 'admin.orcamentos.pesquisar', 'uses' => 'Admin\OrcamentoController@pesquisar']);
    Route::post('/admin/orcamento/pesquisarocamento/', ['as' => 'admin.orcamento.pesquisarorcamento', 'uses' => 'Admin\OrcamentoController@pesquisarOrcamento']);

    // Bancos
    Route::get('/admin/financeiro/banco/', ['as' => 'admin.bancos', 'uses' => 'Admin\BancoController@index']);
    Route::get('/admin/financeiro/banco/adicionar', ['as' => 'admin.bancos.adicionar', 'uses' => 'Admin\BancoController@adicionar']);
    Route::post('/admin/financeiro/banco/inserir', ['as' => 'admin.bancos.inserir', 'uses' => 'Admin\BancoController@inserir']);
    Route::get('/admin/financeiro/banco/editar/{id}', ['as' => 'admin.bancos.editar', 'uses' => 'Admin\BancoController@editar'])->where('id', '[0-9]+');
    Route::put('/admin/financeiro/banco/atualizar/{id}', ['as' => 'admin.bancos.atualizar', 'uses' => 'Admin\BancoController@atualizar'])->where('id', '[0-9]+');

    // Agentes
    Route::get('/admin/financeiro/agente', ['as' => 'admin.agentes', 'uses' => 'Admin\AgenteController@index']);
    Route::get('/admin/financeiro/agente/adicionar', ['as' => 'admin.agentes.adicionar', 'uses' => 'Admin\AgenteController@adicionar']);
    Route::post('/admin/financeiro/agente/inserir', ['as' => 'admin.agentes.inserir', 'uses' => 'Admin\AgenteController@inserir']);
    Route::get('/admin/financeiro/agente/editar/{id}', ['as' => 'admin.agentes.editar', 'uses' => 'Admin\AgenteController@editar'])->where('id', '[0-9]+');
    Route::put('/admin/financeiro/agente/atualizar/{id}', ['as' => 'admin.agentes.atualizar', 'uses' => 'Admin\AgenteController@atualizar'])->where('id', '[0-9]+');

    // Formas de pagamentos
    Route::get('/admin/financeiro/forma_pagamento', ['as' => 'admin.pagamentos', 'uses' => 'Admin\PagamentoController@index']);
    Route::get('/admin/financeiro/forma_pagamento/adicionar', ['as' => 'admin.pagamentos.adicionar', 'uses' => 'Admin\PagamentoController@adicionar']);
    Route::post('/admin/financeiro/forma_pagamento/inserir', ['as' => 'admin.pagamentos.inserir', 'uses' => 'Admin\PagamentoController@inserir']);
    Route::get('/admin/financeiro/forma_pagamento/editar/{id}', ['as' => 'admin.pagamentos.editar', 'uses' => 'Admin\PagamentoController@editar'])->where('id', '[0-9]+');
    Route::put('/admin/financeiro/forma_pagamento/atualizar/{id}', ['as' => 'admin.pagamentos.atualizar', 'uses' => 'Admin\PagamentoController@atualizar'])->where('id', '[0-9]+');

    // Caixa
    Route::get('/admin/financeiro/caixa/', ['as' => 'admin.caixa', 'uses' => 'Admin\CaixaController@index']);
    Route::get('/admin/financeiro/caixa/relatorio/', ['as' => 'admin.caixa.relatorio', 'uses' => 'Admin\CaixaController@relatorio']);
    Route::post('/admin/financeiro/caixa/recebimento/', ['as' => 'admin.caixa.recebimento', 'uses' => 'Admin\CaixaController@recebimento']);
    Route::post('/admin/financeiro/caixa/relatorio/gerado/', ['as' => 'admin.caixa.gerador', 'uses' => 'Admin\CaixaController@gerador']);

    // Ordem de Serviço
    Route::get('/admin/ordemservico/', ['as' => 'admin.ordemservico', 'uses' => 'Admin\OrdemServicoController@index']);
    Route::get('/admin/ordemservico/{id}', ['as' => 'admin.ordemservico.form', 'uses' => 'Admin\OrdemServicoController@formulario'])->where('id', '[0-9]+');
    Route::get('/admin/ordemservico/adicionar/{id_orcamento}', ['as' => 'admin.ordemservico.adicionar', 'uses' => 'Admin\OrdemServicoController@adicionar'])->where('id_orcamento', '[0-9]+');
    Route::post('/admin/ordemservico/editarservico/', ['as' => 'admin.ordemservico.editarservico', 'uses' => 'Admin\OrdemServicoController@editarservico']);
    Route::post('/admin/ordemservico/finalizarservico/', ['as' => 'admin.ordemservico.finalizarservico', 'uses' => 'Admin\OrdemServicoController@finalizarservico']);
});
