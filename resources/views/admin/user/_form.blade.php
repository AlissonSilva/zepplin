
<div class="row form-group">
    <div class="col-sm-2">
        <label for="" class="label">Foto: </label>
        <div class="input-field">
            <img width="100" src="{{asset($registros->foto)}}" alt="" />
        </div>
        <input type="file" name="foto" class="form-control form-control-user" id="foto" >
    </div>
    <div class="col-sm-4">
        <label for="" class="label">Nome: </label>
        <input type="text" name="name" class="form-control form-control-user" id="name" value="{{isset($registros->name) ? $registros->name : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
        <div class="invalid-feedback">
            Campo nome é obrigatório
        </div>
    </div>
    <div class="col-sm-4">
        <label for="" class="label">E-mail: </label>
        <input type="email" name="email" class="form-control form-control-user" id="email" value="{{isset($registros->email) ? $registros->email : '' }}" required>
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-2">
        <label for="" class="label">Senha: </label>
        <input type="password" name="password" class="form-control form-control-user" id="password" value="" value="{{isset($registros->senha) ? '' : 'required' }}" >
    </div>
    <div class="col-sm-2">
        <label for="" class="label">Perfil: </label>
        <select name="perfil" id="perfil" class="form-control form-control">
            <option>Selecionar um perfil</option>

            @foreach ($perfil as $opt)
                    @if (isset($opt->id_perfil) && isset($registros) )
                        @if ( $registros->id_perfil == $opt->id_perfil )
                            <option value="{{$opt->id_perfil}}" selected>{{$opt->descricao}}</option>
                        @else
                            <option value="{{$opt->id_perfil}}">{{$opt->descricao}}</option>
                        @endif
                    @else
                        <option value="{{$opt->id_perfil}}">{{$opt->descricao}}</option>
                    @endif
            @endforeach
        </select>
    </div>

    <div class="col-sm-2">
        <label for="" class="label">Status: </label>
        <input type="checkbox" name="ativo" class="form-control form-control-user" id="ativo" {{isset($registros->ativo) && $registros->ativo == 1 ? 'checked' : ''}} value="true" >
    </div>

    @if ($message = Session::get('success'))
            <div class="alert alert-info alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
     @endif
</div>


