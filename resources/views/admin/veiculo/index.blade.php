@extends('layout.site')

@section('titulo','SIGOM : Veículos')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Veículos</h1>

    @if (!isset($cliente->nome) || !isset($cliente->razao_social))
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Adicionar veículo</a>
    @endif

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">


        @foreach($registros as $r)
            {{ $i = $r->id_cliente }}
        @endforeach

        @if (isset($i))

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabela dos veículos cadastrados</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <label for="" class="label">Cliente</label>
                    </div>
                </div>
                <div class="table-responsive">


                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
                        <thead>
                          <tr>
                              <th>Placa</th>
                              <th>Descricação</th>
                              <th>Modelo</th>
                              <th>Fabricante</th>
                              <th>Ano Mod./Fabr.</th>
                              <th>Cor</th>

                              <th></th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($registros as $registro)

                            <tr>
                                <td> {{$registro->placa}} </td>
                                <td> {{$registro->descricao_veiculo}} </td>
                                <td> {{$registro->modelo}} </td>
                                <td> {{$registro->fabricante}} </td>
                                <td> {{$registro->ano}} / {{$registro->fabricacao}}</td>
                                <td> {{$registro->cor}} </td>
                                <td><a href="{{ route('admin.veiculos.editar', [ 'id_cliente'=>$registro->id_cliente, 'id'=>$registro->id_veiculo]) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Editar</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        @else


        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Adicionar um novo veículo</h6>
        </div>
          <div class="card-body">
            <div class="form-veiculo">

                @if (isset($cliente->nome)||isset($cliente->razao_social))

                <div class="row">

                    <div class="col-sm-2">
                        <label for="" class="label">Código Cliente: </label>
                        <input type="text" name="id_cliente" class="form-control form-control-user" id="id_cliente" value="{{isset($cliente->id_cliente)? $cliente->id_cliente : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  disabled>
                    </div>

                    <div class="col-sm-6">
                        <label for="" class="label">Nome: </label>
                        <input type="text" name="nomecliente" class="form-control form-control-user" id="nomecliente" value="{{isset($cliente->nome)? $cliente->nome : $cliente->razao_social }}"  onChange="javascript:this.value=this.value.toUpperCase();"  disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="" class="label">Documento: </label>
                        <input type="text" name="documento" class="form-control form-control-user" id="documento" value="{{isset($cliente->cpf)? $cliente->cpf : $cliente->cnpj}}"  onChange="javascript:this.value=this.value.toUpperCase();"  disabled>
                    </div>
                </div>
                @endif

                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                @include('admin.veiculo._form')
                <div class="row form-group">
                    <div class="col-sm-10">
                        <button class="btn btn btn-primary " id="adicionarVeiculo">Adicionar</button>
                    </div>
                </div>
            </div>
            <div id="resultadoVeiculo"></div>
          </div>


        @endif
        </div>

</div>
@endsection

