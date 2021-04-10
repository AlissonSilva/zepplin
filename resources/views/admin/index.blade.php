@extends('layout.site')

@section('titulo','SIGOM : Dashboard')

@section('conteudo')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Orçamentos Abertas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{$dashboard->quantidade_aberta}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-wrench fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Orçamentos Aprovados
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$dashboard->quantidade_aprovado}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-thumbs-up fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Valor Recebido</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{ number_format($dashboard->valor_recebido, 2, ',', '.') }}</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-xl-8 col-lg-7">
            <div class="col-xl-9 col-lg-5">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Gráfico Aberto x Fechados</h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                        <p class="highcharts-description">
                            Demonstrativo em valores dos orçamentos aprovados x abertos
                        </p>
                    </figure>
                  </div>
                </div>
              </div>
        </div>
    </div>

</div>

<script>
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Referente aos últimos 30 dias'
    },
    tooltip: {
        pointFormat: '{series.y}: <b>{series.name:.1f}</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.y}</b>: {point.name:.1f}'
            }
        }
    },

    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [ {
            name: 'Valor Recebido',
            y: {{ number_format($dashboard->valor_recebido, 2, '.', '') }}
        }, {
            name: 'Valor em Aberto',
            y: {{ number_format($dashboard->valor_em_aberto, 2, '.', '') }}
        }]
    }]
});
</script>
@endsection

