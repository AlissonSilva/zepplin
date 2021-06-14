@extends('layout.site')

@section('titulo','SIGOM : Ordem de Serviço')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ordem de Serviço</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabela de ordem de serviço</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
              <thead>
                <tr>
                    <th>Cód. Orçamento</th>
                    <th>Status Orçamento</th>
                    <th>Cliente</th>
                    <th>Documento</th>
                    <th>Fabricante</th>
                    <th>Modelo</th>
                    <th>Status OS</th>
                    <th>Observação</th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($registros as $registro)
                <tr>
                    <td>{{$registro->id_orcamento}}</td>
                    <td><span class="badge badge-success">{{strtoupper($registro->status_orcamento)}}</span></td>
                    <td>{{$registro->nome}}</td>
                    <td>{{$registro->documento}}</td>
                    <td>{{$registro->fabricante}}</td>
                    <td>{{$registro->modelo}}</td>
                    <td>{{$registro->status_servico}}</td>
                    <td>{{$registro->observacao}}</td>
                    {{--  <td>{{isset($registro->id_ordemservico)?$registro->id_ordemservico:$registro->id_orcamento}}</td>  --}}
                    <td><a href="{{ isset($registro->id_ordemservico) ? route('admin.ordemservico.form',$registro->id_ordemservico) : route('admin.ordemservico.adicionar',$registro->id_orcamento)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> {{isset($registro->id_ordemservico)? 'Visualizar':'Iniciar'}} </a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection

