@extends('layout.site')
<script type="text/javascript">
    var token = '{{ csrf_token() }}';
</script>
@section('titulo','SIGOM : Orçamento')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ordem de Serviço</h1>
    </div>
    <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ordem de Serviço </h6>
    </div>
    <div class="card-body">
        <div class="form-cidade">
            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

            <div class="row form-group">
                <div class="col-sm-2">
                    <label for="" class="label">Ordem de Serviço: </label>
                    <input type="text" name="id_orcamento" class="form-control form-control-user" id="id_orcamento" value="{{$registros->id_ordemservico}}" disabled required>
                </div>
                <div class="col-sm-2">
                    <label for="" class="label">Cód. Orçamento: </label>
                    <input type="text" name="id_orcamento" class="form-control form-control-user" id="id_orcamento" value="{{$registros->id_orcamento}}" disabled required>
                </div>
                <div class="col-sm-3">
                    <label for="" class="label">Cliente: </label>
                    <input type="text" name="id_orcamento" class="form-control form-control-user" id="id_orcamento" value="{{$registros->nome}}" disabled required>
                </div>
                <div class="col-sm-3">
                    <label for="" class="label">Documento: </label>
                    <input type="text" name="id_orcamento" class="form-control form-control-user" id="id_orcamento" value="{{$registros->documento}}" disabled required>
                </div>

            </div>

            <div class="row form-group">
                <div class="col-sm-3">
                    <label for="">Veiculo:</label>
                    <input type="text" name="veiculo" class="form-control form-control-user" id="veiculo" value="{{$registros->modelo}} - {{$registros->fabricante}} " disabled required>
                </div>
                <div class="col-sm-2">
                    <label for="">Placa:</label>
                    <input type="text" name="placa" class="form-control form-control-user" id="placa" value="{{$registros->placa}}  " disabled required>
                </div>
                <div class="col-sm-2">
                    <label for="">Fabricação / Modelo:</label>
                    <input type="text" name="ano_fabricacao_modelo" class="form-control form-control-user" id="ano_fabricacao_modelo" value="{{$registros->ano}} / {{$registros->fabricacao}}" disabled required>
                </div>
                <div class="col-sm-3">
                    <label for="">Observação:</label>
                    <input type="text" name="observacao" class="form-control form-control-user" id="ano_fabricacao_modelo" value="{{$registros->observacao}}" disabled required>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-2">
                    <label for="" class="label">Status O.S.:</label><br>
                    @if ($registros->status_servico == 'não iniciado')
                        <span class="badge badge-danger">{{$registros->status_servico}}</span>
                    @elseif($registros->status_servico == 'iniciado')
                        <span class="badge badge-success">{{$registros->status_servico}}</span>
                    @elseif($registros->status_servico == 'pausado')
                        <span class="badge badge-secondary">{{$registros->status_servico}}</span>
                    @elseif($registros->status_servico == 'finalizado')
                        <span class="badge badge-primary">{{$registros->status_servico}}</span>
                    @endif
                </div>

                <div class="col-sm-2">
                    <label>Prioridade:</label>
                    <select name="prioridade" id="prioridade" class="form-control form-control" >
                        <option value="baixa" {{$registros->prioridade == 'baixa'?'selected':''}}>Baixa</option>
                        <option value="media" {{$registros->prioridade == 'media'?'selected':''}}>Média</option>
                        <option value="alta" {{$registros->prioridade == 'alta'?'selected':''}}>Alta</option>
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-11">
                    <table class="table" style="font-size: 12px">
                        <thead>
                            <tr>
                                <th>
                                    Serviço
                                </th>
                                <th>
                                    Status
                                </th>

                                <th>
                                    Data Hora Gerado
                                </th>
                                <th>
                                    Data Hora Inicio
                                </th>
                                <th>
                                    Data Hora Finalização
                                </th>
                                <th>
                                    Funcionário
                                </th>
                                <th>
                                    Ação
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($servicos as $item)
                            <tr>
                                <td>
                                    {{$item->descricao}}
                                </td>
                                <td>
                                    {{$item->status_servico}}
                                </td>
                                <td>
                                    {{date('d/m/Y H:m:s', $item->created_at) }}
                                </td>
                                <td>
                                    {{ isset($item->data_hora_inicio) ? date('d/m/Y H:m:s',strtotime($item->data_hora_inicio)):'' }}
                                </td>
                                <td>
                                    {{ isset($item->data_hora_finalizacao) ? date('d/m/Y H:m:s', strtotime($item->data_hora_finalizacao)):'' }}
                                </td>

                                <td class="employee">
                                    <select name="funcionario" class="form-select" id="funcionario" {{isset($item->data_hora_inicio)?'disabled':''}}>
                                        <option value="0">SELECIONAR UM FUNCIONÁRIO</option>
                                        @foreach ($funcionarios as $employee)
                                            <option value="{{$employee->id}}" {{isset($item->id_funcionario)? ($item->id_funcionario = $employee->id)? 'selected':'' :''}}>{{$employee->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    @if (!isset($item->data_hora_inicio))
                                        <button class="iniciar btn btn-success btn-sm">Iniciar</button>
                                    @elseif(isset($item->data_hora_inicio) && isset($item->data_hora_inicio))
                                        <button class="finalizar btn btn-warning btn-sm">Finalizar</button>
                                    @else
                                        <button class="finalizar btn btn-warning btn-sm" disabled>Finalizar</button>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-sm-10">
                    <button class="btn btn-primary btn-sm">Alterar</button>
                    <button class="btn btn-success btn-sm">Iniciar</button>
                    <button class="btn btn-warning btn-sm">Finalizar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".iniciar").click(function() {
            var $row = $(this).closest("tr");    // Find the row
            var $text = $row.find(".employee option:selected").val(); // Find the text

            // Let's test it out
            alert($text);
        });
    </script>

@endsection
