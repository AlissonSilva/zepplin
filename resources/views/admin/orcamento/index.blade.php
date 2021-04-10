@extends('layout.site')

@section('titulo','SIGOM : Orçamentos')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabela de clientes </h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
              <thead>
                <tr>
                    <th>#Cód. Cliente</th>
                    <th>Nome</th>
                    <th>Documento</th>
                    <th></th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($registros as $registro)
                <tr>
                    <td>{{$registro->id_cliente}}</td>
                    <td>{{$registro->nome}}</td>
                    <td>{{$registro->documento}}</td>
                    <td><a href="{{route('admin.orcamentos.lista', $registro->id_cliente)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm {{$registro->count_orcamento > 0 ? '': 'disabled' }}"  >Visualizar Orçamentos</a></td>
                    <td><a href="{{route('admin.orcamentos.novo', $registro->id_cliente)}}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">Novo Orçamento</button></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection

