@extends('layout.site')
<script type="text/javascript">
    var token = '{{ csrf_token() }}';
</script>
@section('titulo','SIGOM : Usuário')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuário</h1>
    </div>
    <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Adicionar um novo usuário</h6>
          </div>
          <div class="card-body">
            <div class="form-usuario">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                @include('admin.user._form')
                <div class="row form-group">
                    <div class="col-sm-10">
                        <button class="btn btn btn-primary " id="adicionarUsuario">Adicionar</button>
                    </div>
                </div>
            </div>
            <div id="resultadoUsuario"></div>
          </div>
    </div>
</div>

@endsection
