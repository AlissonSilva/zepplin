@extends('layout.site')

@section('titulo','SIGOM : Pessoa Física')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pessoa Física</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Editar cadastro de pessoa física</h6>
        </div>
        <div class="card-body">
            <form action="{{route('admin.pessoafisica.atualizar', $registros->id_pessoa_fisica)}}"  method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put" >
                @include('admin.pessoafisica._form')
                <div class="row form-group">
                    <div class="col-sm-10">
                        <button class="btn btn btn-primary ">Atualizar</button>
                        <a class="btn btn-secondary" href="{{route('admin.pessoafisica.editar',$registros->id_pessoa_fisica)}}">Voltar</a>
                    </div>
                </div>
            </form>

            @if ($message = Session::get('success'))
            <div class="alert alert-info alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
