
<div class="row form-group">
    <div class="col-sm-5">
        <label for="" class="label">Nome: </label>
        <input type="text" name="name" class="form-control form-control-user" id="name" value="{{isset($registros->name) ? $registros->name : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
        <div class="invalid-feedback">
            Campo nome é obrigatório
        </div>
    </div>
    <div class="col-sm-5">
        <label for="" class="label">E-mail: </label>
        <input type="email" name="email" class="form-control form-control-user" id="email" value="{{isset($registros->email) ? $registros->email : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-5">
        <label for="" class="label">Senha: </label>
        <input type="password" name="password" class="form-control form-control-user" id="password" value="{{isset($registros->password)? $registros->password : '' }}" required>
    </div>
    <div class="col-sm-5">
        <label for="" class="label">Status: </label>
        <input type="checkbox" name="ativo" class="form-control form-control-user" id="ativo" {{isset($registros->ativo) && $registros->ativo == 1 ? 'checked' : ''}} value="true" >
    </div>
</div>


