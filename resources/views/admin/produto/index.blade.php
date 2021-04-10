@extends('layout.site')

@section('titulo','SIGOM : Produtos')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produtos</h1>
    <a href="{{route('admin.produtos.adicionar')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Adicionar produto</a>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabela dos produtos cadastrados</h6>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
              <thead>
                <tr>
                    <th>#Id</th>
                    <th>Descricação</th>
                    <th>UC</th>
                    <th>Preço</th>
                    <th>Status</th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($registros as $registro)
                <tr>
                    <td>{{$registro->id_produto}}</td>
                    <td>{{$registro->descricao}}</td>
                    <td>{{$registro->unidade}}</td>
                    <td>{{$registro->preco}}</td>
                    <td>
                        @if ($registro->ativo)
                        Ativo
                    @else
                        Inativo
                    @endif
                    </td>
                    <td><a href="{{route('admin.produtos.editar', $registro->id_produto)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Editar</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection

