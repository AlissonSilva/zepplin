@extends('layout.site')

@section('titulo','SIGOM : Pessoa Física')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pessoa Física</h1>
        <a href="{{route('admin.pessoafisica.adicionar')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Adicionar uma nova pessoa física</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabela de Pessoas Física</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
                <thead>
                  <tr>
                      <th>#Id</th>
                      <th>Nome</th>
                      <th>CPF</th>
                      <th>Cliente</th>
                      <th>Fornecedor</th>
                      <th></th>
                      <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($registros as $registro)
                  <tr>
                      <td>{{$registro->id_pessoa_fisica}}</td>
                      <td>{{$registro->nome}}</td>
                      <td>{{$registro->cpf}}</td>
                      <td>@if ($registro->cliente)
                          Sim
                      @else
                          Não
                      @endif</td>
                      <td>@if ($registro->fornecedor)
                        Sim
                    @else
                        Não
                    @endif</td>
                      <td><a href="{{route('admin.pessoafisica.editar',$registro->id_pessoa_fisica)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Editar</a></td>
                      <td><a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">Excluir</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

          </div>
        </div>
      </div>
</div>
@endsection

