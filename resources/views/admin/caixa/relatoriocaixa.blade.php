@extends('layout.site')

@section('titulo','SIGOM : Caixa')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Caixa</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Filtro Caixa</h6>
        </div>
        <div class="card-body">
          
          <form action="{{route('admin.caixa.gerador')}}"  method="POST" enctype="multipart/form-data">

            {{ csrf_field() }}
            <div class="row form-group">
              <div class="col-sm-4">
                  <label for="" class="label">Data Início: </label>
                  <input type="date" name="data-inicio" class="form-control form-control-user" id="data-inicio"   required>
              </div>
              <div class="col-sm-4">
                  <label for="" class="label">Data Fim: </label>
                  <input type="date" name="data-fim" class="form-control form-control-user" id="data-inicio"   required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-4">
                  <label for="" class="label">Usuário Início: </label>
                  <input type="number" name="cod_user_inicio" class="form-control form-control-user" id="cod_user_inicio" value="0000" required>
              </div>
              <div class="col-sm-4">
                  <label for="" class="label">Usuário Fim: </label>
                  <input type="number" name="cod_user_fim" class="form-control form-control-user ddd" id="cod_user_fim" value="9999" required>
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

