
<div class="row form-group">
    <div class="col-sm-2">
        <label for="" class="label">Código: </label>
        <input type="number" name="codigo" class="form-control form-control-user" id="codigo" value="{{isset($registros->codigo) ? $registros->codigo : '' }}" required>
    </div>

    <div class="col-sm-3">
        <label for="" class="label">Titular: </label>
        <input type="text" name="titular" class="form-control form-control-user" id="titular" value="{{isset($registros->titular) ? $registros->titular : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
    </div>


    <div class="col-sm-3">
        <label for="" class="label">Banco: </label>
        <select name="id_banco" id="id_banco" class="form-control form-control">
            @foreach ($bancos as $obj)
                <option value="{{$obj->id_banco}}" >{{$obj->descricao}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-3">
        <label for="" class="label">Tipo de Conta: </label>
        <input type="text" name="tipo_conta" class="form-control form-control-user" id="tipo_conta" value="{{isset($registros->tipo_conta)? $registros->tipo_conta : '' }}" required>
    </div>
    <div class="col-sm-2">
        <label for="" class="label">Agencia: </label>
        <input type="number" name="agencia" class="form-control form-control-user" id="agencia" value="{{isset($registros->agencia)? $registros->agencia : '' }}" required>
    </div>
    <div class="col-sm-2">
        <label for="" class="label">Conta: </label>
        <input type="number" name="conta" class="form-control form-control-user" id="conta" value="{{isset($registros->conta)? $registros->conta : '' }}" required>
    </div>
    <div class="col-sm-1">
        <label for="" class="label">Digito: </label>
        <input type="txt" name="digito" class="form-control form-control-user" id="digito" value="{{isset($registros->digito)? $registros->digito : '' }}" onChange="javascript:this.value=this.value.toUpperCase();"  required>
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-2">
        <label for="" class="label">Ativo: </label>
        <input type="checkbox" name="ativo" class="form-control form-control-user" id="ativo_produto" {{isset($registros->ativo) && $registros->ativo == 1 ? 'checked' : ''}} value="true" >
    </div>
</div>
