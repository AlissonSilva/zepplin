@extends('layout.site')

@section('titulo','SIGOM : Caixa')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Caixa</h1>
        <label><div id="valor_selecionado" ><h3>Valor Selecionado: 0,00</h3></div></label>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Receber</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Baixa Manual</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table " id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
              <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Documento</th>
                    <th>Parcela</th>
                    <th>Valor Parcela</th>
                    <th>Status Pagamento</th>
                    <th>Data Geração</th>
                    <th>Data Vencimento</th>
                    <th>Detalhes</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($registros as $registro)
                <tr>
                    <td><input type="checkbox" id="{{$registro->id_cobranca}}" value="{{$registro->valor_parcela}}" ></td>
                    <td>{{$registro->nome}}</td>
                    <td>{{$registro->documento}}</td>
                    <td>{{$registro->num_parcela}}</td>
                    <td>{{$registro->valor_parcela}}</td>
                    <td>{{$registro->status_pagamento}}</td>
                    <td>{{$registro->data_geracao}}</td>
                    <td>{{$registro->data_vencimento}}</td>
                    <td><a href="#" class=" btn btn-sm btn-outline-info " > <i class="fas fa-eye"></i> </a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</div>

<script>

    $(document).ready(function(){
        var valorSelecionado = 0.0;
        $('input[type="checkbox"]').change(function(){
            //alert( $(this).val() );
            var xeck = $(this);
            if(xeck.is( ":checked" )){
                valorSelecionado = valorSelecionado + parseFloat($(this).val());
            }else{
                valorSelecionado = valorSelecionado - parseFloat($(this).val());
            }
            // $('#myCheckbox').attr('checked', true);


            // alert(valorSelecionado);
            $('#valor_selecionado').html('<h3> Valor Selecionado: '+valorSelecionado+'</h3');
        });
    });
</script>
@endsection

