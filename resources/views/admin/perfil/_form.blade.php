
<div class="row form-group">
    <div class="col-sm-7">
        <label for="" class="label">Descrição: </label>
        <input type="text" name="descricao" class="form-control form-control-user" id="descricao-pl" value="{{isset($registros->descricao)? $registros->descricao : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>


<div class="row form-group">
    <div class="col-sm-2">
        <label for="" class="label">Administrador: </label>
        <input type="checkbox" name="admin" class="form-control form-control-user" id="admin-pl" {{isset($registros->admin) && $registros->admin == 1 ? 'checked' : ''}} >
    </div>
    <div class="col-sm-2">
        <label for="" class="label">Status: </label>
        <input type="checkbox" name="ativo" class="form-control form-control-user" id="ativo-pl" {{isset($registros->ativo) && $registros->ativo == 1 ? 'checked' : ''}} >
    </div>
</div>
