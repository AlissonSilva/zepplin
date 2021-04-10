@extends('layout.site')

@section('titulo','SIGOM : Cidades')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cidades</h1>
        <a href="{{route('admin.cidades.adicionar')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Adicionar uma cidade</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabela das cidades cadastradas</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
              <thead>
                <tr>
                    <th>#Id</th>
                    <th>Cidade</th>
                    <th>UF</th>
                    <th>Capital</th>
                    <th></th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($registros as $registro)
                <tr>
                    <td>{{$registro->id_cidade}}</td>
                    <td>{{$registro->cidade}}</td>
                    <td>{{$registro->uf}}</td>
                    <td>@if ($registro->capital)
                        Sim
                    @else
                        Não
                    @endif</td>
                    <td><a href="{{route('admin.cidades.editar', $registro->id_cidade)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Editar</a></td>
                    <td><button onclick="deletarRegistroCidade({{$registro->id_cidade}}, '{{$registro->cidade}}')" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">Excluir</button></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection

