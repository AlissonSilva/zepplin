
<style>
.each{
    border-bottom: 1px solid #555;
    padding: 3px 0;
}
.acItem .name{
    padding: 5px;
  font-size: 14px;
}

.acItem .desc{
    padding: 5px;
  font-size: 10px;
  color:#555;
}

</style>
<div class="row form-group">
    <div class="col-sm-2">
        <label for="" class="label">Cód. Orçamento: </label>
        <input type="text" name="id_orcamento" class="form-control form-control-user" id="id_orcamento" value="{{isset($objOcamento->ido_orcamento) ? $objOcamento['id_orcamento'] : $objOcamento['id_orcamento']   }}" onChange="javascript:this.value=this.value.toUpperCase();" disabled required>
    </div>

    <div class="col-sm-5">

        <label for="" class="label">Nome: </label>
        <input type="text" name="nome" class="form-control form-control-user" id="nome" value="{{isset($registros->nome)? $registros->nome : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" disabled required>
        <input type="text" name="id_cliente" class="form-control form-control-user" id="id_cliente" value="{{isset($registros->id_cliente)? $registros->id_cliente : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" style="display: none">
    </div>
    <div class="col-sm-4">
        <label for="" class="label">CPF/CNPJ: </label>
        <input type="text" name="documento" class="form-control form-control-user" id="documento" value="{{isset($registros->documento)? $registros->documento : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" disabled required>
    </div>
</div>


<div class="row form-group">
    <div class="col-sm-4">
        <label for="" class="label">Veículo: </label>
        <select name="id_veiculo" id="id_veiculo" class="form-control form-control" {{ is_null($orcamento->id_veiculo) ? '':'disabled'}}>
            <option value="null" selected>Selecionar Veículo</option>
            @foreach ($veiculos as $opt)
                    @if (isset($orcamento->id_veiculo))
                        <option value="{{$opt->id_veiculo}}" selected>{{$opt->placa .' | '. $opt->descricao_veiculo}}</option>
                    @else
                        <option value="{{$opt->id_veiculo}}" >{{$opt->placa .' | '. $opt->descricao_veiculo}}</option>
                    @endif

            @endforeach
        </select>
    </div>

    <div class="col-sm-4" style="margin: 15px">
        <div class="row ">
            <label for="" class="label">Status: </label>
        </div>
        <div class="row ">
            @if ($orcamento->status_orcamento == 'aberto')
                <span class="badge badge-primary">{{$orcamento->status_orcamento}}</span>
            @elseif($orcamento->status_orcamento == 'cancelado')
                <span class="badge badge-danger">{{$orcamento->status_orcamento}}</span>
            @elseif($orcamento->status_orcamento == 'fechado')
                <span class="badge badge-secondary">{{$orcamento->status_orcamento}}</span>
            @elseif($orcamento->status_orcamento == 'aprovado')
                <span class="badge badge-success">{{$orcamento->status_orcamento}}</span>
            @endif

        </div>

    </div>
</div>

<div class="row form-group">
    <div class="col-sm-3">
        <label for="" class="label">Produto/Serviço:</label>
        <input type="text" name="id_produto" id="id_produto" style="display: none" value="" {{$orcamento->status_orcamento != 'aberto'?'disabled':''}}>
        <input type="text" name="tipo" id="tipo" style="display: none" value="" {{$orcamento->status_orcamento != 'aberto'?'disabled':''}}>
        <input type="text" name="produto" class="form-control form-control-user" id="produto" value="" {{$orcamento->status_orcamento != 'aberto'?'disabled':''}}  >
    </div>
    <div class="col-sm-2">
        <label for="" class="label">Valor unitário:</label>
        <input type="text" name="valor_unitario" class="form-control form-control-user" id="valor_unitario" value="" onChange="javascript:this.value=this.value.toUpperCase();" required disabled>
    </div>
    <div class="col-sm-1">
        <label for="" class="label">Quantidade:</label>
        <input type="text" name="quantidade" class="form-control form-control-user" id="quantidade" value="0" onChange="javascript:this.value=this.value.toUpperCase();" {{$orcamento->status_orcamento != 'aberto'?'disabled':''}} required>
        <input type="text" style="display:none" name="estoque" class="form-control form-control-user" id="estoque" value="0" onChange="javascript:this.value=this.value.toUpperCase();" {{$orcamento->status_orcamento != 'aberto'?'disabled':''}}  required>
    </div>
    <div class="col-sm-1">
        <label for="" class="label">% Desc.:</label>
        <input type="text" name="percentual_desconto" class="form-control form-control-user" id="percentual_desconto" value="0.0" onChange="javascript:this.value=this.value.toUpperCase();" {{$orcamento->status_orcamento != 'aberto'?'disabled':''}} required>
    </div>
    <div class="col-sm-2">
        <label for="" class="label">Valor Desc.:</label>
        <input type="text" name="valor_desconto" class="form-control form-control-user" id="valor_desconto" value="0.0" onChange="javascript:this.value=this.value.toUpperCase();" {{$orcamento->status_orcamento != 'aberto'?'disabled':''}} required>
    </div>

    <div class="col-sm-2">
        <label for="" class="label">Valor Total:</label>
        <input type="text" name="valor_total" class="form-control form-control-user" id="valor_total" value="0.0" onChange="javascript:this.value=this.value.toUpperCase();" disabled required>
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-11">
        @if ($orcamento->status_orcamento != 'aberto')

        @else
            <button id="btn-add-item" class="btn btn-circle btn-danger float-right" >+</button>
        @endif

    </div>
</div>
<div class="resultado_itemorcamento form-group col-sm-12 " id="resultado_itemorcamento">
    <table class="table-active table" id="tabela_item_orcamento">
        <thead>
            <tr>
                <th>Cód. Item</th>
                <th>Desc</th>
                <th>Qtd</th>
                <th>Valor Unid.</th>
                <th>% Desc.</th>
                <th>Valor Desc.</th>
                <th>Valor Total</th>
                <th></th>
            </tr>
            <tbody>
                {{ print_r($tabelaItem['tabela']) }}
            </tbody>
        </thead>
    </table>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-info alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="form-group ">
    <div class="row ">
        <div class="col-sm-3 float-right">
            <label for="" class="label">Desconto:</label>
            <input type="text" name="orca_desconto" class="form-control form-control-user" id="orca_desconto" value="{{isset($orcamento->valor_desconto)?$orcamento->valor_desconto:'0.0'}}" disabled >
        </div>
    </div>

    <div class="row ">
        <div class="col-sm-3 float-right">
            <label for="" class="label">Valor Total S/ Desconto:</label>
            <input type="text" name="orca_valor_total_sem_desconto" class="form-control form-control-user" id="orca_valor_total_sem_desconto" value="{{isset($orcamento->valor_total_sem_desconto)?$orcamento->valor_total_sem_desconto:'0.0'}}" disabled >
        </div>
    </div>
    <div class="row ">
        <div class="col-sm-3 float-right">
            <label for="" class="label">Valor Total:</label>
            <input type="text" name="orca_valor_total" class="form-control form-control-user" id="orca_valor_total" value="{{isset($orcamento->valor_total)?$orcamento->valor_total:'0.0'}}" disabled >
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
           $('#produto').autocomplete({
               source:function(request,response){
                   $.getJSON('/api/apisigom/produto/autocomplete?term='+request.term,function(data){
                        var array = $.map(data,function(row){
                            return {
                                label:row.descricao,
                                valor_unitario:row.preco,
                                estoque:row.estoque,
                                id_produto: row.id_produto,
                                tipo: row.tipo
                            }
                        });
                        response($.ui.autocomplete.filter(array,request.term));
                   });
               },
               minLength:1,
               delay:500,
               select:function(event,ui){
                   if (ui.item.estoque == 0) {
                       alert('Item com estoque zerado');
                       return false
                   } else {
                        $('#produto').val(ui.item.label);
                        $('#valor_unitario').val(ui.item.valor_unitario);
                        $('#quantidade').val(1);
                        $('#estoque').val(ui.item.estoque);
                        $('#valor_total').val(ui.item.valor_unitario * 1);
                        $('#id_produto').val(ui.item.id_produto);
                        $('#tipo').val(ui.item.tipo);
                        return false;
                   }
               }
           }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li class='each'>")
                .append("<div class='acItem'><span class='name'>" +
                    "Item: "+item.label + "</span><br><span class='desc'>" +
                    "Estoque: "+item.estoque + "</span><br><span class='desc'>" +
                    "Valor Unitario: "+item.valor_unitario.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}) + "</span></div>")
                .appendTo(ul);
            };

           $("#quantidade").bind("change paste keyup", function() {
                $('#valor_total').val($('#valor_unitario').val() * $(this).val())
            });

           $("#percentual_desconto").bind("change paste keyup", function() {
               if($(this).val()>0){
                    var desc = ($(this).val() * ( $('#valor_unitario').val() * $('#quantidade').val() )) / 100;
                    var total = ($('#valor_unitario').val() * $('#quantidade').val()) - desc;
                    $('#valor_desconto').val(desc);
                    $('#valor_total').val(total);
               }else{
                    $('#valor_desconto').val(0.0);
                    $('#valor_total').val($('#valor_unitario').val()*$('#quantidade').val())
               }
            });

            $('#btn-add-item').click(function(){
                if($('#quantidade').val() > $('#estoque').val() && $('#tipo').val() == 'produto'){
                    alert('Quantidade maior que a disponibilidade em estoque. \nQuantidade: '+$('#quantidade').val()+'; Estoque: '+$('#estoque').val());
                }else if ($('#id_produto').val() == '' || $('#valor_unitario').val() == '' || $('#quantidade').val() == '' || $('#valor_desconto').val()== '' || $('#percentual_desconto').val()==''){
                    alert('Verificar os seguintes campos: Produto/Serviço, Valor unitário, quantidade, % Desc, Valor Desc, Valot Total');
                }else if ($('#id_veiculo').val() == 'null'){
                    alert("Selecionar um veículo valido");
                }else{
                    var id_orcamento = $('#id_orcamento').val();
                    var nome = $('#nome').val();
                    var id_cliente = $('#id_cliente').val();
                    var documento = $('#documento').val();
                    var id_veiculo = $('#id_veiculo').val();
                    var id_produto = $('#id_produto').val();
                    var valor_unitario = $('#valor_unitario').val();
                    var quantidade = $('#quantidade').val();
                    var percentual_desconto = $('#percentual_desconto').val();
                    var valor_desconto = $('#valor_desconto').val();
                    var valor_total = $('#valor_total').val();
                    var id_user = {{Auth::user()->id}} ;
                    var tipo = $('#tipo').val();

                    $.ajax({
                        type: 'post',
                        url: '/admin/orcamento/inseriritemorcamento',
                        header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'), id_orcamento: id_orcamento, nome:nome, id_cliente: id_cliente, documento:documento, id_veiculo: id_veiculo,
                            id_produto: id_produto, valor_unitario: valor_unitario, quantidade:quantidade, percentual_desconto: percentual_desconto,
                            valor_desconto: valor_desconto, valor_total:valor_total, id_user : id_user, tipo: tipo
                        },
                        success: function (e) {
                            $('#resultado_itemorcamento').html(e.tabela);
                            $('#orca_desconto').val(e.valor_desconto);
                            $('#orca_valor_total_sem_desconto').val(e.valor_total_sem_desconto);
                            $('#orca_valor_total').val(e.valor_total);
                            console.log(e);
                        }
                    });
            }

                $('#quantidade').val(0);
                $('#id_produto').val("");
                $('#percentual_desconto').val(0.0);
                $('#valor_unitario').val("");
                $('#valor_desconto').val(0.0);
                $('#valor_total').val(0.0);
                $('#produto').val("");
            });
})
</script>

