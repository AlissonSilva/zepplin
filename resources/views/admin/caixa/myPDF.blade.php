
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Caixa</title>
    <style>
table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
}
table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
footer { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 50px; }
    </style>
</head>
<body>

    <h1 style="text-align:center" >RELATÓRIO DE MOVIMENTAÇÃO DE CAIXA</h1>
<br><br>
    <table>
        <thead>
            <tr>
                <th align="CENTER">
                    FILTRO
                </th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    Data Inicio
                </td>

                <td>
                    {{ date('d/m/Y', strtotime($data_inicio)) }}
                </td>
            </tr>

            <tr>
                <td>
                    Data Fim
                </td>

                <td>
                    {{ date('d/m/Y', strtotime($data_fim)) }}
                </td>
            </tr>

            <tr>
                <td>
                    Usuário Inicio
                </td>

                <td>
                    {{$cod_user_inicio}}
                </td>
            </tr>

            <tr>
                <td>
                    Usuário Fim
                </td>

                <td>
                    {{$cod_user_fim}}
                </td>
            </tr>
        </tbody>
    </table> <br><br>

    <table class="blueTable">
        <thead>
        <tr>
            <th>Data Recebimento</th>
            <th>Cód. Usuário</th>
            <th>Nome Usuário</th>
            <th>Valor Recebido</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($registros as $item)
            <tr>
                <td>{{ date('d/m/Y', strtotime($item->data_recebimento)) }}</td>
                <td>{{$item->id_user}}</td>
                <td>{{$item->name}}</td>
                <td>R$ {{ number_format($item->valor_recebido, 2, ',', '.') }}</td>
            </tr>
            @endforeach
            @foreach ($total as $obj_total)
            <tr>
                <td colspan="3">
                    Total
                </td>
                <td>
                    R$ {{ number_format($obj_total->valor_total, 2, ',', '.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>

        <footer >
            <p>{{date('d/m/Y H:i')}} - {{Auth::user()->name}} ({{Auth::user()->id}})<p>
        </footer>

</body>
</html>
