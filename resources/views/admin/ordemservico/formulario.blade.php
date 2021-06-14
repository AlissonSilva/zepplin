@extends('layout.site')
<script type="text/javascript">
    var token = '{{ csrf_token() }}';
</script>
@section('titulo','SIGOM : Orçamento')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ordem de Serviço</h1>
    </div>
    <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ordem de Serviço </h6>
    </div>
    <div class="card-body">
        <div class="form-cidade">
            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

            <div class="row form-group">
                <div class="col-sm-2">
                    <label for="" class="label">Ordem de Serviço: </label>
                    <input type="text" name="id_orcamento" class="form-control form-control-user" id="id_orcamento" value="{{$registros->id_ordemservico}}" disabled required>
                </div>
                <div class="col-sm-2">
                    <label for="" class="label">Cód. Orçamento: </label>
                    <input type="text" name="id_orcamento" class="form-control form-control-user" id="id_orcamento" value="{{$registros->id_orcamento}}" disabled required>
                </div>
                <div class="col-sm-3">
                    <label for="" class="label">Cliente: </label>
                    <input type="text" name="id_orcamento" class="form-control form-control-user" id="id_orcamento" value="{{$registros->nome}}" disabled required>
                </div>
                <div class="col-sm-3">
                    <label for="" class="label">Documento: </label>
                    <input type="text" name="id_orcamento" class="form-control form-control-user" id="id_orcamento" value="{{$registros->documento}}" disabled required>
                </div>
                
            </div>

            <div class="row form-group">
                <div class="col-sm-2">
                    <label for="" class="label">
                        Status O.S.:
                    </label>
                    @if ($registros->status_servico == 'não iniciado')
                    <span class="badge badge-primary">{{$registros->status_servico}}</span>
                    @elseif($registros->status_servico == 'iniciado')
                        <span class="badge badge-danger">{{$registros->status_servico}}</span>
                    @elseif($registros->status_servico == 'pausado')
                        <span class="badge badge-secondary">{{$registros->status_servico}}</span>
                    @elseif($registros->status_servico == 'finalizado')
                        <span class="badge badge-success">{{$registros->status_servico}}</span>
                    @endif
                </div>

                <div class="col-sm-2">
                    Prioridade
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-2">
                    <button>Alterar</button>
                    <button>Iniciar</button>
                    <button>Finalizar</button>
                </div>
            </div>
        </div>
    </div>

@endsection