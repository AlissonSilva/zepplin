@extends('layout.site')

@section('titulo','SIGOM : Agente Financeiro')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Agente Financeiro</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Editar Agente Financeiro</h6>
        </div>
        <div class="card-body">
            <form action="{{route('admin.agentes.atualizar', $registros->id_agente)}}"  method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put" >
                @include('admin.agente._form')
                <div class="row form-group">
                    <div class="col-sm-10">
                        <button class="btn btn btn-primary ">Atualizar</button>
                        <a class="btn btn-secondary" href="{{route('admin.agentes')}}">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
