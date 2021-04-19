
<div class="row form-group">
    <div class="col-sm-5">
        <label for="" class="label">Código de Compensação: </label>
        <input type="number" name="codigo_banco" class="form-control form-control-user" id="codigo_banco" value="{{isset($registros->codigo) ?  str_pad($registros->codigo , 3 , '0' , STR_PAD_LEFT) : '' }}" {{isset($registros->codigo) ? 'disabled' : '' }}   required>
    </div>
    <div class="col-sm-5">
        <label for="" class="label">Descrição do Banco: </label>
        <input type="text" name="descricao_banco" class="form-control form-control-user" id="descricao_banco" value="{{isset($registros->descricao) ? $registros->descricao: '' }}"  onChange="javascript:this.value=this.value.toUpperCase();"  required>
    </div>
</div>

@isset($agentes)

<div class="col-lg-10 mb-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Agentes Financeiro</h6>
        </div>
        <div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px">
                      <thead>
                        <tr>
                            <th>#Id</th>
                            <th>Titular</th>
                            <th>Agencia</th>
                            <th>Conta / Digito</th>
                            <th>Tipo de Conta</th>
                            <th></th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($agentes as $agente)

                          <tr>
                            <td>{{$agente->id_agente}}</td>
                            <td>{{$agente->titular}}</td>
                            <td>{{$agente->agencia}}</td>
                            <td>{{$agente->conta}} - {{$agente->digito}}</td>
                            <td>{{$agente->tipo_conta}}</td>
                            <td><a href="{{route('admin.agentes.editar',$agente->id_agente)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Editar</a></td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
    
@endisset