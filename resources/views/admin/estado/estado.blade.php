@extends('layout.site')

@section('titulo','SIGOM : Estados')

@section('conteudo')



<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estados</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Visualização do Estado: {{ $registro->uf }} - {{ $registro->estado}}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Estado</h6>
                        </div>
                        <div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">#Id:</div>
                                    <div class="h5 mb-0 font-weight-light text-gray-800" style="margin-left: 2%">{{$registro->id_estado}}</div>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <div class="row">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">UF:</div>
                                        <div class="h5 mb-0 font-weight-light text-gray-800" style="margin-left: 2%">{{$registro->uf}}</div>
                                    </div>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <div class="row">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Estado:</div>
                                        <div class="h5 mb-0 font-weight-light text-gray-800" style="margin-left: 2%">{{$registro->estado}}</div>
                                    </div>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <div class="row">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Capital:</div>
                                        <div class="h5 mb-0 font-weight-light text-gray-800" style="margin-left: 2%">{{$registro->cidade}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Municípios</h6>
                        </div>
                        <div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
                                      <thead>
                                        <tr>
                                            <th>#Id</th>
                                            <th>Cidade</th>
                                            <th>Capital</th>
                                            <th>DDD</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                          @foreach ($municipios as $municipio)

                                          <tr>
                                            <td>{{$municipio->id_cidade}}</td>
                                            <td>{{$municipio->cidade}}</td>
                                            <td>{{$municipio->capital == 1? 'Sim' : 'Não'}}</td>
                                            <td>{{$municipio->ddd}}</td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
