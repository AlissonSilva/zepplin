
<div class="row form-group">
    <div class="col-sm-4">
        <label for="" class="label">Descrição: </label>
        <input type="text" name="descricao" class="form-control form-control-user" id="descricao_veiculo" value="{{isset($registros->descricao)? $registros->descricao : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" required>
    </div>
    <div class="col-sm-4">
        <label for="" class="label">Modelo: </label>
        <input type="text" name="modelo" class="form-control form-control-user" id="modelo" value="{{isset($registros->modelo)? $registros->modelo : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" required>
    </div>
    <div class="col-sm-4">
        <label for="" class="label">Fabricante: </label>
        <input type="text" name="fabricante" class="form-control form-control-user" id="fabricante" value="{{isset($registros->fabricante)? $registros->fabricante : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" required>
    </div>

</div>


<div class="row form-group">
    <div class="col-sm-4">
        <label for="" class="label">Placa: </label>
        <input type="text" name="placa" class="form-control form-control-user" id="placa" value="{{isset($registros->placa)? $registros->placa : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" required>
    </div>
    <div class="col-sm-2">
        <label for="" class="label">Ano do modelo:  </label>
        <input type="Number" name="ano" class="form-control form-control-user" id="ano" value="{{isset($registros->ano)? $registros->ano : '' }}" required>
    </div>
    <div class="col-sm-2">
        <label for="" class="label">Ano de fabricação: </label>
        <input type="Number" name="fabricacao" class="form-control form-control-user" id="fabricacao" value="{{isset($registros->fabricacao)? $registros->fabricacao : '' }}" required>
    </div>
    <div class="col-sm-4">
        <label for="" class="label">Cor: </label>
        <input type="text" name="cor" class="form-control form-control-user" id="cor" value="{{isset($registros->cor)? $registros->cor : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="row form-group">

    <div class="col-sm-12">
        <label for="" class="label">Observação: </label>
        <input type="text" name="observacao" class="form-control form-control-user" id="observacao" value="{{isset($registros->observacao)? $registros->observacao : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>


