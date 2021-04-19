@extends('layout.site')

@section('titulo','SIGOM : Forma de pagamento')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Forma de pagamento</h1>
        <a href="{{route('admin.pagamentos.adicionar')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Adicionar uma nova forma de pagamento</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabela forma de pagamentos</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
              <thead>
                <tr>
                    <th>Nome</th>
                    <th>Agente Financeiro</th>
                    <th>Nº máx. parcelas</th>
                    <th>Intervalo entre parcelas (dias)</th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($registros as $registro)
                <tr>
                    <td>{{$registro->descricao}}</td>
                    <td>{{$registro->titular }} ( Agencia: {{$registro->agencia}} - Conta-Dig: {{$registro->conta}} - {{$registro->digito}}  )</td>
                    <td>{{$registro->numero_parcelas}}</td>
                    <td>{{$registro->intervalo_parcelas}}</td>
                    <td><a href="{{route('admin.pagamentos.editar', $registro->id_pagamento)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Editar</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection

