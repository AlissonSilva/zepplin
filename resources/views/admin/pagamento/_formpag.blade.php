<div class="form-group ">
    <div class="row ">
        <div class="col-md-9">
            <label for="" class="label">Valor Recebido:</label>
            <input type="text" name="valor_receber" class="form-control form-control-user" id="valor_receber" value="{{isset($valorAPagar) ?  $valorAPagar :'0.0'}}" disabled >
            <label for="" class="label">Forma de Pagamento:</label>
            @if (($orcamento->valor_total - $valorAPagar) <= 0)
                <select name="id_pagamento" id="id_pagamento" class="form-control form-control" disabled>
                </select>
            @else
                <select name="id_pagamento" id="id_pagamento" class="form-control form-control">
                    <option value="" >Forma de Pagamento</option>
                    @foreach ($pagamentos as $obj)
                        <option value="{{$obj->id_pagamento}}" data-info="{{$obj->numero_parcelas}}" {{isset($registros->id_pagamento)?($registros->id_pagamento == $obj->id_pagamento?'selected':''):''}} >{{$obj->forma_pagamento}}</option>
                    @endforeach
                </select>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div id="result_p"></div>
        </div>
    </div>
    <div class="row">
        <div id="result_tabela">

        </div>
    </div>
</div>

<script>
    var valor_receber = $('#valor_receber').val()
    $("#id_pagamento").change(function () {
        var parcela = $(this).find(':selected').data("info");
        $('#result_p').html('<label for="" class="label">Parcelas</label> <select name="parcelas" id="parcelas" class="form-control form-control"></select> <label for="" class="label">Valor:</label><input type="text" name="valor_parcela" class="form-control form-control-user" id="valor_parcela" value="0.0" ><br><button id="adicionar_forma_pagamento_orcamento" onClick="eventos()" class="btn btn-success">Adicionar</button>')
        for(i=1;i<=parcela;i++){
            $("#parcelas").append('<option value="'+i+'">'+i+'</option>');
        }
    });
    function eventos(){
        var parcela = $('#parcelas').val();
        var valor = $('#valor_parcela').val();
        var id_pagamento = $('#id_pagamento').val();
        var id_orcamento = $('#id_orcamento_m').val();

        $('#valor_receber').val(valor_receber - valor);
        $.ajax({
                type: 'post',
                url: '/admin/financeiro/forma_pagamento/pagamento_orcamento',
                header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: { _token: $('meta[name="csrf-token"]').attr('content'), parcela:parcela, valor:valor, id_pagamento:id_pagamento, id_orcamento:id_orcamento},
                success: function (e) {
                    console.log(e);
                    $('#result_tabela').html(e.msg);
                }
        })
    }
</script>
