@extends('layout.site')
<script type="text/javascript">
    var token = '{{ csrf_token() }}';
</script>
@section('titulo','SIGOM : Orçamento')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orçamento</h1>
    </div>
    <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Novo Orçamento </h6>
          </div>
          <div class="card-body">
            <div class="form-cidade">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                @include('admin.orcamento._form')
                <div class="row form-group">
                    <div class="col-sm-10">
                            <button class="btn btn btn-primary" id="salvarOrcamento" style="margin: 5px" {{ $orcamento->status_orcamento != 'aberto' ? 'disabled' :'' }} >{{ $orcamento->salvo == 0 ? 'Salvar' : 'Alterar'}} </button>
                            <button class="btn btn-success" id="formaPagamento" style="margin: 5px" {{$orcamento->salvo == 0 || $orcamento->status_orcamento != 'aberto' ? 'disabled':''}} data-toggle="modal" data-target="#modalFormaPagamento">Forma de Pagamento</button>
                            <button class="btn btn-warning" id="aprovarOrcamento" style="margin: 5px" {{$orcamento->salvo == 0 || $orcamento->status_orcamento != 'aberto' ? 'disabled':''}}>Aprovar</button>
                            <button class="btn btn-danger" id="cancelarOrcamento" style="margin: 5px" {{$orcamento->salvo == 0 || $orcamento->status_orcamento != 'aberto' ? 'disabled':''}}>Cancelar</button>
                            <a class="btn btn-info  {{$orcamento->salvo == 0 || ($orcamento->status_orcamento != 'aberto' && $orcamento->status_orcamento != 'aprovado' )  ? 'disabled':''}}" id="imprimirOrcamento"  href="{{route('admin.orcamentos.printer',$orcamento->id_orcamento)}}" style="margin: 5px" target="_blank">Imprimir</a>
                            <a class="btn btn-secondary"  href="{{route('admin.orcamentos')}}" style="margin: 5px" >Voltar</a>
                    </div>
                </div>
            </div>
            <div id="resultadoPerfil"></div>

            @if ($orcamento->salvo == 0 || $orcamento->status_orcamento == 'aberto')
                <!-- Modal -->
                <div class="modal fade" id="modalFormaPagamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Forma de Pagamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group ">
                                <div class="row ">
                                    <div class="col-md-4">
                                        <label for="" class="label">Orçamento:</label>
                                        <input type="text" name="id_orcamento_m" class="form-control form-control-user" id="id_orcamento_m" value="{{isset($orcamento->id_orcamento)?$orcamento->id_orcamento:'0'}}" disabled >
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="label">Valor à receber:</label>

                                        <input type="text" name="valor_receber" class="form-control form-control-user" id="valor_receber" value="{{isset($orcamento->valor_total) ? $orcamento->valor_total - $valorRecebido :'0.0'}}" disabled >
                                    </div>
                                </div>
                                <div class="row ">

                                </div>
                            </div>
                            @include('admin.pagamento._formpag')
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                    </div>
                </div>
            @endif
          </div>
    </div>
</div>

@endsection

