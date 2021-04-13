@extends('layout.site')

@section('titulo','SIGOM : Usuários')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuários</h1>
        <a href="{{route('admin.user.adicionar')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Adicionar usuário</a>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabela de usuários cadastrados</h6>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
              <thead>
                <tr>
                    <th>#Id</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Perfil</th>
                    <th>Status</th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($registros as $registro)
                <tr>
                    <td>{{$registro->id}}</td>
                    <td>{{$registro->name}}</td>
                    <td>{{$registro->email}}</td>
                    <td>{{$registro->id_perfil}}</td>
                    <td>
                        @if ($registro->ativo)
                        Ativo
                    @else
                        Inativo
                    @endif
                    </td>
                    <td><a href="{{route('admin.user.editar',$registro->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Editar</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection

