@extends('layout.site')
<script type="text/javascript">
    var token = '{{ csrf_token() }}';
</script>
@section('titulo','SIGOM : Veículo')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Veículo</h1>
    </div>
    <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Adicionar um novo Veículo</h6>
          </div>
          <div class="card-body">
            <div class="form-produto">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

                <div class="row">

                    <div class="col-sm-2">
                        <label for="" class="label">Código Cliente: </label>
                        <input type="text" name="id_cliente" class="form-control form-control-user" id="id_cliente" value="{{isset($registros->id_cliente)? $registros->id_cliente : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  disabled>
                    </div>

                    <div class="col-sm-6">
                        <label for="" class="label">Nome: </label>
                        <input type="text" name="nomecliente" class="form-control form-control-user" id="nomecliente" value="{{isset($registros->nome)? $registros->nome : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="" class="label">Documento: </label>
                        <input type="text" name="documento" class="form-control form-control-user" id="documento" value="{{isset($registros->documento)? $registros->documento : ''}}"  onChange="javascript:this.value=this.value.toUpperCase();"  disabled>
                    </div>
                </div>

                @include('admin.veiculo._form')
                <div class="row form-group">
                    <div class="col-sm-10">
                        <button class="btn btn btn-primary " id="adicionarVeiculo">Adicionar</button>
                        <a class="btn btn-secondary" href="{{route('admin.veiculos', $registros->id_cliente)}}">Voltar</a>
                    </div>
                </div>
            </div>
            <div id="resultadoVeiculo"></div>
          </div>
    </div>
</div>

@endsection
