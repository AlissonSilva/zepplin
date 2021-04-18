
<div class="row form-group">
    <div class="col-sm-5">
        <label for="" class="label">Código de Compensação: </label>
        <input type="number" name="codigo_banco" class="form-control form-control-user" id="codigo_banco" value="{{isset($registros->codigo) ? $registros->codigo : '' }}"   required>
    </div>
    <div class="col-sm-5">
        <label for="" class="label">Descrição do Banco: </label>
        <input type="text" name="descricao_banco" class="form-control form-control-user" id="descricao_banco" value="{{isset($registros->descricao) ? $registros->descricao: '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
    </div>
</div>
