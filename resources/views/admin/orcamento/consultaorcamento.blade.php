@extends('layout.site')

<script src="https://www.geradorcnpj.com/assets/js/jquery.maskedinput-1.1.4.pack.js" type="text/javascript"></script>
<script type="text/javascript">
    var token = '{{ csrf_token() }}';
</script>
@section('titulo','SIGOM : Orçamento')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orçamento</h1>
    </div>
    <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pesquisar Orçamento</h6>
          </div>
          <div class="card-body">
            <div class="form-cidade">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

                <div class="row form-group">

                    <div class="col-sm-4">
                        <label for="" class="label">Pesquisar Por: </label>
                        <select name="tipo_pesquisa" id="tipo_pesquisa" class="form-control form-control">
                            <option value="0" >CNPJ</option>
                            <option value="1" >CPF</option>
                            <option value="2" >Cod. Orcamento</option>
                            <option value="3" >Nome do Cliente</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="" class="label">&emsp; </label>
                        <input type="text" name="descricao" class="form-control form-control-user" id="descricao-pl" value="" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-10">
                        <button class="btn btn btn-primary " id="pesquisarorcamento">Pesquisar</button>
                    </div>
                </div>
            </div>
            <div id="resultadoPesquisaOrcamento"></div>
          </div>
    </div>
</div>

<script>
    var typevalue = '';

    $('#pesquisarorcamento').click(function(e){
        // alert(typevalue);
        var desc = $("#descricao-pl").val();
        $.ajax({
            type: 'post',
            url: '/admin/orcamento/pesquisarocamento/',
            header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { _token: $('meta[name="csrf-token"]').attr('content'), typevalue: typevalue, descricao: desc },
            success: function (e) {
                $('#resultadoPesquisaOrcamento').html(e);
            }
        });
    });

    $("#tipo_pesquisa").change(function () {
        typevalue = $(this).find(':selected').val();

        if(typevalue == 0){
            $("#descricao-pl")
                .attr('type','text')
                .val('')
                .mask('99.999.999/9999-99');
        }else if(typevalue == 1){
            $("#descricao-pl")
                .val('')
                .attr('type','text')
                .mask("999.999.999-99");
            
        }else if(typevalue == 2){
            $("#descricao-pl").val('')
                .attr('type','number');
        }else if(typevalue == 3){
            $("#descricao-pl").val('')
                .attr('type','text')
                .mask('');
        }

        /* $('#result_p').html('<label for="" class="label">Parcelas</label> <select name="parcelas" id="parcelas" class="form-control form-control"></select> <label for="" class="label">Valor:</label><input type="text" name="valor_parcela" class="form-control form-control-user" id="valor_parcela" value="0.0" ><br><button id="adicionar_forma_pagamento_orcamento" onClick="eventos()" class="btn btn-success">Adicionar</button>')
        for(i=1;i<=parcela;i++){
            $("#parcelas").append('<option value="'+i+'">'+i+'</option>');
        }*/ 

    });
</script>

@endsection

