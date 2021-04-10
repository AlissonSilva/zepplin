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
                            <button class="btn btn-warning" id="aprovarOrcamento" style="margin: 5px" {{$orcamento->salvo == 0 || $orcamento->status_orcamento != 'aberto' ? 'disabled':''}}>Aprovar</button>
                            <button class="btn btn-danger" id="cancelarOrcamento" style="margin: 5px" {{$orcamento->salvo == 0 || $orcamento->status_orcamento != 'aberto' ? 'disabled':''}}>Cancelar</button>
                            <a class="btn btn-info  {{$orcamento->salvo == 0 || ($orcamento->status_orcamento != 'aberto' && $orcamento->status_orcamento != 'aprovado' )  ? 'disabled':''}}" id="imprimirOrcamento"  href="{{route('admin.orcamentos.printer',$orcamento->id_orcamento)}}" style="margin: 5px" target="_blank">Imprimir</a>
                            <a class="btn btn-secondary"  href="{{route('admin.orcamentos')}}" style="margin: 5px" >Voltar</a>

                    </div>
                </div>
            </div>
            <div id="resultadoPerfil"></div>
          </div>
    </div>
</div>

@endsection

