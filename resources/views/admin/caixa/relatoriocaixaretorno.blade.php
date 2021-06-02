@extends('layout.site')

@section('titulo','SIGOM : Caixa')

@section('conteudo')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Caixa</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Filtro Caixa</h6>
        </div>
        <div class="card-body">
            <div class="accordion accordion-flush" id="accordionFlushExample">
             @foreach ($registros as $registro)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        {{$registro->data_recebimento}}
                    </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">This is the first items accordion body.</div>
                    </div>
                </div>
             @endforeach
            </div>
        </div>
      </div>
</div>
@endsection

