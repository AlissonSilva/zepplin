
<div class="row form-group">
    <div class="col-sm-5">
        <label for="" class="label">Cidade: </label>
        <input type="text" name="cidade" class="form-control form-control-user" id="cidade" value="{{isset($registros->cidade) ? $registros->cidade : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
    </div>
    <div class="col-sm-5">
        <label for="" class="label">UF: </label>
        <select name="id_estado" id="id_estado" class="form-control form-control">
            @foreach ($estados as $opt)
                    @if (isset($registros->uf) && $opt->uf == $registros->uf )
                        <option value="{{$opt->id_estado}}" selected>{{$opt->uf}}</option>
                    @else
                        <option value="{{$opt->id_estado}}">{{$opt->uf}}</option>
                    @endif
            @endforeach
        </select>
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-5">
        <label for="" class="label">Código IBGE: </label>
        <input type="number" name="ibge" class="form-control form-control-user" id="ibge" value="{{isset($registros->ibge)? $registros->ibge : '' }}" required>
    </div>
    <div class="col-sm-5">
        <label for="" class="label">DDD: </label>
        <input type="number" name="ddd" class="form-control form-control-user ddd" id="ddd" value="{{isset($registros->ddd)? $registros->ddd : '' }}" required>
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-2">
        <label for="" class="label">Capital: </label>
        <input type="checkbox" name="capital" class="form-control form-control-user" id="capital" {{isset($registros->capital) && $registros->capital == 1 ? 'checked' : ''}} >
    </div>
</div>
