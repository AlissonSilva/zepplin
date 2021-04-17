@extends('layout.site')

@section('titulo','SIGOM : Banco')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bancos</h1>
        <a href="{{ route('admin.bancos.adicionar') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Adicionar uma banco</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabela dos bancos cadastrados</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
              <thead>
                <tr>
                    <th>#Id</th>
                    <th>Banco</th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($registros as $registro)
                <tr>
                    <td>{{$registro->id_banco}}</td>
                    <td>{{$registro->descricao}}({{ str_pad($registro->codigo , 3 , '0' , STR_PAD_LEFT) }})</td>
                    <td><a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Editar</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection

