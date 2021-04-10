
<div class="row form-group">
    <div class="col-sm-5">
        <label for="" class="label">Descrição: </label>
        <input type="text" name="descricao" class="form-control form-control-user" id="descricao_produto" value="{{isset($registros->descricao) ? $registros->descricao : '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
        <div class="invalid-feedback">
            Campo descrição é obrigatório
        </div>
    </div>
    <div class="col-sm-5">
        <label for="" class="label">Unidade de Medida: </label>
        <select name="unidade" id="unidade_produto" class="form-control form-control">
            <option value="UN" {{ isset($registros->unidade) && $registros->unidade == 'UN'?'selected':''}}>UN - Unidade (padrão)</option>
            <option value="CT" {{ isset($registros->unidade) && $registros->unidade == 'CT'?'selected':''}}>CT - Cartela</option>
            <option value="CX" {{ isset($registros->unidade) && $registros->unidade == 'CX'?'selected':''}}>CX - Caixa</option>
            <option value="DZ" {{ isset($registros->unidade) && $registros->unidade == 'DZ'?'selected':''}}>DZ - Duzia</option>
            <option value="GS" {{ isset($registros->unidade) && $registros->unidade == 'GS'?'selected':''}}>GS - Grosa</option>
            <option value="PA" {{ isset($registros->unidade) && $registros->unidade == 'PA'?'selected':''}}>PA - Par</option>
            <option value="PC" {{ isset($registros->unidade) && $registros->unidade == 'PC'?'selected':''}}>PC - Peça</option>
            <option value="PT" {{ isset($registros->unidade) && $registros->unidade == 'PT'?'selected':''}}>PT - Pacote</option>
            <option value="RL" {{ isset($registros->unidade) && $registros->unidade == 'RL'?'selected':''}}>RL - Rolo</option>
        </select>
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-4">
        <label for="" class="label">Preço do Produto: </label>
        <input type="number" name="preco" class="form-control form-control-user" id="preco_produto" value="{{isset($registros->preco)? $registros->preco : '' }}" required>
    </div>
    <div class="col-sm-4">
        <label for="" class="label">Quantidade: </label>
        <input type="number" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');"  name="quantidade" class="form-control form-control-user" id="quantidade_produto" value="{{isset($registros->quantidade)? $registros->quantidade : '' }}" required>
    </div>
    <div class="col-sm-2">
        <label for="" class="label">Status: </label>
        <input type="checkbox" name="ativo" class="form-control form-control-user" id="ativo_produto" {{isset($registros->ativo) && $registros->ativo == 1 ? 'checked' : ''}} value="true" >
    </div>

</div>


