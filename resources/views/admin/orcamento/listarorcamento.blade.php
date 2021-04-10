@extends('layout.site')

@section('titulo','SIGOM : Orçamentos')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orçamentos</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Orçamentos por clientes </h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
              <thead>
                <tr>
                    <th>#Cód. Orçamento</th>
                    <th>Val. Desc.</th>
                    <th>Méd. Desc.</th>
                    <th>Val. Total S/ Desc.</th>
                    <th>Valor Total</th>
                    <th></th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($registros as $registro)
                <tr>
                    <td>{{$registro->id_orcamento}}</td>
                    <td>{{$registro->valor_desconto}}</td>
                    <td>{{$registro->percentual_desconto}}</td>
                    <td>{{$registro->valor_total_sem_desconto}}</td>
                    <td>{{$registro->valor_total}}</td>
                    <td>
                    @if ($registro->status_orcamento == 'aberto')
                        <span class="badge badge-primary">{{$registro->status_orcamento}}</span>
                    @elseif($registro->status_orcamento == 'cancelado')
                        <span class="badge badge-danger">{{$registro->status_orcamento}}</span>
                    @elseif($registro->status_orcamento == 'fechado')
                        <span class="badge badge-secondary">{{$registro->status_orcamento}}</span>
                    @elseif($registro->status_orcamento == 'aprovado')
                        <span class="badge badge-success">{{$registro->status_orcamento}}</span>
                    @endif

                    </td>
                    <td><a href="{{route('admin.orcamentos.adicionar', [$registro->id_cliente, $registro->id_orcamento])}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "  >Visualizar Orçamento</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>
@endsection

