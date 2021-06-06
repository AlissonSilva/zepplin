@extends('layout.site')
<script type="text/javascript">
    var token = '{{ csrf_token() }}';
</script>
@section('titulo','SIGOM : Orçamento')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orçamento</h1>
    </div>
    <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pesquisar Orçamento</h6>
          </div>
          <div class="card-body">
            <div class="form-cidade">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

                <div class="row form-group">

                    <div class="col-sm-4">
                        <label for="" class="label">Pesquisar Por: </label>
                        <select name="tipo_pesquisa" id="tipo_pesquisa" class="form-control form-control">
                            <option value="0" >CNPJ</option>
                            <option value="1" >CPF</option>
                            <option value="2" >Cod. Orcamento</option>
                            <option value="2" >Nome do Cliente</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="" class="label">&emsp; </label>
                        <input type="text" name="descricao" class="form-control form-control-user" id="descricao-pl" value="" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-10">
                        <button class="btn btn btn-primary " id="pesquisarorcamento">Pesquisar</button>
                    </div>
                </div>
            </div>
            <div id="resultadoPesquisaOrcamento"></div>
          </div>
    </div>
</div>

@endsection

