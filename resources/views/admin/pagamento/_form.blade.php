
<div class="row form-group">
    <div class="col-sm-5">
        <label for="" class="label">Descrição: </label>
        <input type="text" name="descricao" class="form-control form-control-user" id="descricao" value="{{isset($registros->descricao)? $registros->descricao : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" required>
    </div>
    <div class="col-sm-4">
        <label for="" class="label">Agente Financeiro: </label>
        <select name="id_agente" id="id_agente" class="form-control form-control">
            @foreach ($agentes as $obj)
                <option value="{{$obj->id_agente}}" {{isset($registros->id_agente)?($registros->id_agente == $obj->id_agente?'selected':''):''}} >{{$obj->descricao}} Ag: {{$obj->agencia}} Conta: {{$obj->conta}} - {{$obj->digito}}</option>
            @endforeach
        </select>
    </div>
</div>


<div class="row form-group">
    <div class="col-sm-2">
        <label for="" class="label">Número máximo de parcelas: </label>
        <input type="number" name="numero_parcelas" class="form-control form-control-user" id="numero_parcelas" value="{{isset($registros->numero_parcelas)? $registros->numero_parcelas : '' }}" required>
    </div>
    <div class="col-sm-3">
        <label for="" class="label">Intervalor entre parcelas (dias): </label>
        <input type="number" name="intervalo_parcelas" class="form-control form-control-user" id="intervalo_parcelas" value="{{isset($registros->intervalo_parcelas)? $registros->intervalo_parcelas : '' }}" required>
    </div>
    <div class="col-sm-2">
        <label for="" class="label">Ativo: </label>
        <input type="checkbox" name="status_pagamento" class="form-control form-control-user" id="status_pagamento" {{isset($registros->status_pagamento) ? ( $registros->status_pagamento == 1 ? 'checked' :'') : ''}} value="true" >
    </div>
</div>
