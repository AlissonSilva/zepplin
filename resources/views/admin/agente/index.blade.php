@extends('layout.site')

@section('titulo','SIGOM : Agentes Financeiro')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Agente Financeiro</h1>
        <a href="{{route('admin.agentes.adicionar')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Adicionar uma agente</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabela dos agentes cadastrados</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
              <thead>
                <tr>
                    <th>#Id</th>
                    <th>Titular</th>
                    <th>Banco</th>
                    <th>Agencia</th>
                    <th>Conta</th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($registros as $registro)
                <tr>
                    <td>{{$registro->id_agente}}</td>
                    <td>{{$registro->titular}}</td>
                    <td>{{$registro->descricao}}</td>
                    <td>{{$registro->agencia}}</td>
                    <td>{{$registro->conta}}-{{ $registro->digito}}</td>
                    <td><a href="{{route('admin.agentes.editar',$registro->id_agente)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Editar</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection

