
@extends('layout.site')
<script type="text/javascript">
    var token = '{{ csrf_token() }}';
</script>
@section('titulo','SIGOM : Agentes')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Agente</h1>
    </div>
    <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Adicionar uma nova Agente</h6>
          </div>
          <div class="card-body">
            <div class="form-agente">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                @include('admin.agente._form')
                <div class="row form-group">
                    <div class="col-sm-10">
                        <button class="btn btn btn-primary " id="adicionarAgente">Adicionar</button>
                        <a class="btn btn-secondary" href="{{route('admin.agentes')}}">Voltar</a>
                    </div>
                </div>
            </div>
            <div id="resultadoAgente"></div>
          </div>
    </div>
</div>

@endsection
