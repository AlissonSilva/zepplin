@extends('layout.site')

@section('titulo','SIGOM : Caixa')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Caixa</h1>

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                              Valor Selecionado
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                               <label><div id="valor_selecionado" ><h3> 0,00</h3></div></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Valor Recebido
                          </div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">
                             <label><div id="valor_recebido" ><h3> {{isset($caixa->vl_recebido ) ? number_format($caixa->vl_recebido, 2, ',', '.') :  '0,00' }}  </h3></div></label>
                             {{-- <label><div id="valor_recebido" ><h3>0,00</h3></div></label> --}}
                          </div>
                      </div>
                  </div>
              </div>
          </div>
       </div>

        <a href="#" id="btn_recebimento" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModal">Receber</a>
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
                    <td> {{number_format($registro->valor_parcela, 2, ',', '.')}}</td>
                    <td>{{$registro->status_pagamento}}</td>
                    <td>{{date('d/m/Y', strtotime($registro->data_geracao)) }} </td>
                    <td>{{date('d/m/Y', strtotime($registro->data_vencimento))}}</td>
                    <td><a href="#" data-id="{{$registro->id_cobranca}}" data-toggle="modal" data-content="<ul><li>Documento de cobrança: {{$registro->id_cobranca}}</li><li>Cliente: {{$registro->nome}}</li><li>Número da parcela: {{$registro->num_parcela}}</li><li> Valor: {{number_format($registro->valor_parcela, 2, ',', '.')}}</li><li>Data Geração: {{date('d/m/Y', strtotime($registro->data_geracao))}}</li><li>Data Vencimento: {{date('d/m/Y', strtotime($registro->data_vencimento))}}</li><li>Data Pagamento: {{date('d/m/Y', strtotime($registro->data_pagamento))}}</li><li>Status: {{$registro->status_pagamento}}</li><li>Forma de pagamento: {{$registro->descricao}}</li><li>Banco: {{$registro->banco}}</li><li>Tipo: {{$registro->tipo_conta}}</li><li>Agencia: {{$registro->agencia}} Conta: {{$registro->conta}}</li>" data-target="#element" class=" btn btn-sm btn-outline-info " > <i class="fas fa-eye"></i> </a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>


      @if ($message = Session::get('success'))
      <div class="alert alert-info alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
      </div>
    @endif
</div>


<div class="modal fade" id="element" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Detalhe da Cobrança</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>



<script>
    $(document).ready(function(){
        var valorSelecionado = 0.0;
        var arrayChk = [];
        $('input[type="checkbox"]').change(function(){
            var xeck = $(this);
            if(xeck.is( ":checked" )){
                valorSelecionado = valorSelecionado + parseFloat($(this).val());
                arrayChk.push($(this).attr('id'));
            }else{
                valorSelecionado = valorSelecionado - parseFloat($(this).val());
                arrayChk.splice(arrayChk.indexOf($(this).attr('id')),1);
            }
            $('#valor_selecionado').html('<h3>'+valorSelecionado.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})+'</h3>');
        });

        $('#element').on('show.bs.modal', function(event) {
          $target = {};
          ['id','button','title','content'].forEach(function(value, key) {
              $target[value] = $(event.relatedTarget).data(value);
          });

         $(".new").addClass('hidden');
          $(".close-changes").text('Salvar').data('button');
          $(".modal-body").html($target.content);
          if ($target.id == 1 || $target.id == 2) {
              $(".close-changes").text($target.button);
          }
            if ($target.id == 3) {
              $(".new").removeClass('hidden');
          }
   });


   $('#btn_recebimento').click(function(){
     if(arrayChk.length == 0 || arrayChk == null){
       alert("Nenhum valor selecionado! Operação não permitida.");
     }else{
        var r = confirm('Receber o valor de '+valorSelecionado.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})+'?');
        if (r) {
            $.ajax({
              type: 'post',
              url: '/admin/financeiro/caixa/recebimento/',
              header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              data: { _token: $('meta[name="csrf-token"]').attr('content'), arrayChk:arrayChk },
              success: function (e) {
                  // $('#valor_recebido').html(e);
                  alert('Valor recebido com sucesso!');
                  location.reload();

              }
          });
        }
     }
   });
});
</script>
@endsection

