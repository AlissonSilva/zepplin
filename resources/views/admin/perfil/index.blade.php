@extends('layout.site')

@section('titulo','SIGOM : Perfil')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perfil</h1>
    <a href="{{route('admin.perfil.adicionar')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Adicionar um novo perfil</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabela dos perfis</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
              <thead>
                <tr>
                    <th>#Id</th>
                    <th>Perfil</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($registros as $registro)
                <tr>
                    <td>{{$registro->id_perfil}}</td>
                    <td>{{$registro->descricao}}</td>
                    <td>{{$registro->ativo == 1 ? 'Ativo': 'Inativo' }}</td>
                    <td><a href="{{route('admin.perfil.editar', $registro->id_perfil)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Editar</a></td>
                    <td><button onclick="deletarRegistroPerfil({{$registro->id_perfil}}, '{{$registro->descricao}}')" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">Excluir</button></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection

