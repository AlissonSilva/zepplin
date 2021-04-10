
<div class="row form-group">
    <div class="col-sm-5">
        <label for="" class="label">Razão Social: </label>
        <input type="text" name="razao_social" class="form-control form-control-user" id="razao_socail-pj" value="{{isset($registros->razao_social)? $registros->razao_social : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" required>
    </div>
    <div class="col-sm-6">
        <label for="" class="label">Nome Fantasia: </label>
        <input type="text" name="fantasia" class="form-control form-control-user" id="fantasia-pj" value="{{isset($registros->fantasia)? $registros->fantasia : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" required>
    </div>

</div>


<div class="row form-group">
    <div class="col-sm-3">
        <label for="" class="label">CNPJ: </label>
        <input type="text" name="cnpj" class="form-control form-control-user cnpj" id="cnpj-pj" value="{{isset($registros->cnpj)? $registros->cnpj : '' }}" onblur="if(!validarCNPJ(this.value)){alert('CNPJ Informado é inválido'); this.value='';}" maxlength="18"  required>
    </div>
    <div class="col-sm-3">
        <label for="" class="label">Data Abertura: </label>
        <input type="date" name="data_abertura" class="form-control form-control-user" id="data_abertura-pj" value="{{isset($registros->data_abertura)? $registros->data_abertura : '' }}" required>
    </div>
    <div class="col-sm-5">
        <label for="" class="label">Natureza Jurídica: </label>
        <select class="form-control" id="cod_natureza_juridica-pj" name="cod_natureza_juridica">
            @foreach ($naturezas as $nf)
                <option value="{{$nf->cod_natureza_juridica}}" {{isset($registros->cod_natureza_juridica) && $registros->cod_natureza_juridica == $nf->cod_natureza_juridica? 'selected' : '' }}>{{$nf->cod_natureza_juridica.' - '.$nf->natureza_juridica }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-3">
        <label for="" class="label">Telefone: </label>
        <input type="tel" name="telefone" class="form-control form-control-user telefone" id="telefone-pj" value="{{isset($registros->telefone)? $registros->telefone : '' }}" required>
    </div>
    <div class="col-sm-3">
        <label for="" class="label">Celular: </label>
        <input type="tel" name="celular" class="form-control form-control-user celular" id="celular-pj" value="{{isset($registros->celular)? $registros->celular : '' }}" required>
    </div>
    <div class="col-sm-5">
        <label for="" class="label">Email: </label>
        <input type="E-mail" name="email" class="form-control form-control-user" id="email-pj" value="{{isset($registros->email)? $registros->email : '' }}" required>
    </div>
</div>


<div class="row form-group">
    <div class="col-sm-4">
        <label for="" class="label">UF: </label>
        <select name="id_estado" id="estado-pj" class="form-control form-control estado">
            <option>Selecionar um estado</option>
            @foreach ($estados as $opt)
                    @if (isset($optMunicipio->id_cidade) && $opt->id_estado == $optMunicipio->id_estado )
                        <option value="{{$opt->id_estado}}" selected>{{$opt->uf}}</option>
                    @else
                        <option value="{{$opt->id_estado}}">{{$opt->uf}}</option>
                    @endif
            @endforeach
        </select>
    </div>

    <div class="col-sm-7">
        <label for="" class="label">Cidade: </label>
        <select name="id_cidade" id="cidade-pj" class="form-control form-control cidade">
            @if (isset($municipios))
            @foreach ($municipios as $city)
                @if ($city->id_cidade == $registros->id_cidade)
                    <option value="{{$city->id_cidade}}" selected>{{$city->cidade}}</option>
                @else
                    <option value="{{$city->id_cidade}}">{{$city->cidade}}</option>
                @endif
            @endforeach

            @endif
        </select>
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-3">
        <label for="" class="label">CEP: </label>
        <input type="text" name="CEP" class="form-control form-control-user cep" id="cep-pj" value="{{isset($registros->cep)? $registros->cep : '' }}" required>
    </div>
    <div class="col-sm-7">
        <label for="" class="label">Endereço: </label>
        <input type="text" name="endereco" class="form-control form-control-user" id="endereco-pj" value="{{isset($registros->endereco)? $registros->endereco : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
    </div>
    <div class="col-sm-1">
        <label for="" class="label">Numero: </label>
        <input type="number" name="numero" class="form-control form-control-user ddd" id="numero-pj" value="{{isset($registros->numero)? $registros->numero : '' }}" required>
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-5">
        <label for="" class="label">Bairro: </label>
        <input type="text" name="bairro" class="form-control form-control-user" id="bairro-pj" value="{{isset($registros->bairro)? $registros->bairro : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
    </div>
    <div class="col-sm-6">
        <label for="" class="label">Complemento: </label>
        <input type="text" name="complemento" class="form-control form-control-user" id="complemento-pj" value="{{isset($registros->complemento)? $registros->complemento : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-2">
        <label for="" class="label">Cliente: </label>

        <input type="checkbox" name="cliente" class="form-control form-control-user" id="cliente-pj" {{isset($registros->cliente) && $registros->cliente == 1 ? 'checked' : ''}} {{isset($veiculo->id_cliente)? 'disabled':''}}>
    </div>
    <div class="col-sm-2">
        <label for="" class="label">Fornecedor: </label>
        <input type="checkbox" name="fornecedor" class="form-control form-control-user" id="fornecedor-pj" {{isset($registros->fornecedor) && $registros->fornecedor == 1 ? 'checked' : ''}} >
    </div>
    @if (isset($registros->cliente) && $registros->cliente == 1)
    <div class="col-sm-2">
        <label for="" class="label"><br/></label>
        <a href="{{isset($cliente->id_cliente) ? route('admin.veiculos', $cliente->id_cliente ) : '#' }}" class="btn btn btn-warning ">{{isset($veiculo->id_cliente)?'Visualizar Veículos':'Adicionar Veículo'}}</a>
    </div>
@endif
</div>
