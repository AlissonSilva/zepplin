@extends('layout.site')

@section('titulo','SIGOM : Estoque')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Relatório de Estoque</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Filtro Estoque</h6>
        </div>
        <div class="card-body">

          <form action="{{route('admin.produtos.gerarpdf')}}"  method="POST" enctype="multipart/form-data">

            {{ csrf_field() }}
            <div class="row form-group">
              <div class="col-sm-4">
                  <label for="" class="label">Cód. Produto Início: </label>
                  <input type="number" name="cod_prod_inicio" class="form-control form-control-user" id="cod_prod_inicio" value="0000" required>
              </div>
              <div class="col-sm-4">
                  <label for="" class="label">Cód. Produto Fim: </label>
                  <input type="number" name="cod_prod_fim" class="form-control form-control-user" id="cod_prod_fim"  value="9999"  required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-4">
                  <label for="" class="label">Preço Início: </label>
                  <input type="number" min="0.00" max="1000000.00" step="0.01" name="preco_inicio" class="form-control form-control-user" id="preco_inicio" value="0.00" required>
              </div>
              <div class="col-sm-4">
                  <label for="" class="label">Preço Fim: </label>
                  <input type="number" min="0.00" max="1000000.00" step="0.01" name="preco_fim" class="form-control form-control-user ddd" id="preco_fim" value="99999.99" required>
              </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-2">
                    <label for="" class="label">Ativo </label>
                    <input type="checkbox" name="ativo" class="form-control form-control-user" id="ativo_produto"  value="true" >
                </div>
                <div class="col-sm-2">
                    <label for="" class="label">Inativo </label>
                    <input type="checkbox" name="inativo" class="form-control form-control-user" id="inativo_produto"  value="false" >
                </div>
            </div>
              <div class="row form-group">
                <div class="col-sm-10">
                    <button class="btn btn btn-primary " id="">Pesquisar</button>
                    <a class="btn btn-secondary" href="#">Limpar</a>
                </div>
            </div>
          </form>
        </div>
      </div>

</div>


@endsection

