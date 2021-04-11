
<div class="row form-group">
    <div class="col-sm-7">
        <label for="" class="label">Nome: </label>
        <input type="text" name="nome" class="form-control form-control-user" id="nome-pf" value="{{isset($registros->nome)? $registros->nome : '' }}" onChange="javascript:this.value=this.value.toUpperCase();" required>
    </div>
    <div class="col-sm-4">
        <label for="" class="label">Data Nascimento: </label>
        <input type="Date" name="dtnascimento" class="form-control form-control-user" id="dtnascimento-pf" value="{{isset($registros->dtnascimento)? $registros->dtnascimento : '' }}" required>
    </div>

</div>


<div class="row form-group">
    <div class="col-sm-3">
        <label for="" class="label">CPF: </label>
        <input type="text" name="cpf" class="form-control form-control-user cpf" id="cpf-pf" value="{{isset($registros->cpf)? $registros->cpf : '' }}" required>
    </div>
    <div class="col-sm-3">
        <label for="" class="label">RG / Inscrição Estadual: </label>
        <input type="Number" name="rg" class="form-control form-control-user" id="rg-pf" value="{{isset($registros->rg)? $registros->rg : '' }}" required>
    </div>
    <div class="col-sm-2">
        <label for="" class="label">Orgão Expeditor: </label>
        <input type="text" name="orgaoexpedidor" class="form-control form-control-user" id="orgaoexpedidor-pf" value="{{isset($registros->orgaoexpedidor)? $registros->orgaoexpedidor : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
    </div>
    <div class="col-sm-3">
        <label for="" class="label">Sexo: </label>
        <select class="form-control" id="sexo-pf">
            <option value="m" {{isset($registros->sexo) && $registros->sexo == 'm'? 'selected' : '' }}>Masculino</option>
            <option value="f" {{isset($registros->sexo) && $registros->sexo == 'f'? 'selected' : '' }}>Feminino</option>
            <option value="o" {{isset($registros->sexo) && $registros->sexo == 'o'? 'selected' : '' }}>Outros</option>
        </select>
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-3">
        <label for="" class="label">Telefone: </label>
        <input type="tel" name="telefone" class="form-control form-control-user telefone" id="telefone-pf" value="{{isset($registros->telefone)? $registros->telefone : '' }}" required>
    </div>
    <div class="col-sm-3">
        <label for="" class="label">Celular: </label>
        <input type="tel" name="celular" class="form-control form-control-user celular" id="celular-pf" value="{{isset($registros->celular)? $registros->celular : '' }}" required>
    </div>
    <div class="col-sm-5">
        <label for="" class="label">Email: </label>
        <input type="E-mail" name="email" class="form-control form-control-user" id="email-pf" value="{{isset($registros->email)? $registros->email : '' }}" required>
    </div>
</div>


<div class="row form-group">
    <div class="col-sm-4">
        <label for="" class="label">UF: </label>
        <select name="id_estado" id="estado-pf" class="form-control form-control estado">
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
        <select name="id_cidade" id="cidade-pf" class="form-control form-control cidade">
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
        <input type="text" name="CEP" class="form-control form-control-user cep" id="cep-pf" value="{{isset($registros->cep)? $registros->cep : '' }}" required>
    </div>
    <div class="col-sm-7">
        <label for="" class="label">Endereço: </label>
        <input type="text" name="endereco" class="form-control form-control-user" id="endereco-pf" value="{{isset($registros->endereco)? $registros->endereco : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
    </div>
    <div class="col-sm-1">
        <label for="" class="label">Numero: </label>
        <input type="number" name="numero" class="form-control form-control-user ddd" id="numero-pf" value="{{isset($registros->numero)? $registros->numero : '' }}" required>
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-5">
        <label for="" class="label">Bairro: </label>
        <input type="text" name="bairro" class="form-control form-control-user" id="bairro-pf" value="{{isset($registros->bairro)? $registros->bairro : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
    </div>
    <div class="col-sm-6">
        <label for="" class="label">Complemento: </label>
        <input type="text" name="complemento" class="form-control form-control-user" id="complemento-pf" value="{{isset($registros->complemento)? $registros->complemento : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-2">
        <label for="" class="label">Cliente: </label>
        <input type="checkbox" name="cliente" class="form-control form-control-user" id="cliente-pf" {{isset($registros->cliente) && $registros->cliente == 1 ? 'checked' : ''}} {{isset($veiculo->id_cliente)?'disabled':''}}>
    </div>
    <div class="col-sm-2">
        <label for="" class="label">Fornecedor: </label>
        <input type="checkbox" name="fornecedor" class="form-control form-control-user" id="fornecedor-pf" {{isset($registros->fornecedor) && $registros->fornecedor == 1 ? 'checked' : ''}}  >
    </div>
    @if (isset($registros->cliente) && $registros->cliente == 1)
        <div class="col-sm-2">
            <label for="" class="label"><br/></label>
            <a href="{{isset($cliente->id_cliente) ? route('admin.veiculos', $cliente->id_cliente ) : '#' }}" class="btn btn btn-warning ">{{isset($veiculo->id_cliente)?'Visualizar Veículos':'Adicionar Veículo'}} </a>
        </div>
    @endif
</div>


