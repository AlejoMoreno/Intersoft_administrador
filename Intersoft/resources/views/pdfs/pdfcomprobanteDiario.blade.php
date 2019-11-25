<head>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <!-- Bootstrap core CSS     -->
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Animation library for notifications   -->
        <link href="/assets/css/animate.min.css" rel="stylesheet"/>
        <!--  Light Bootstrap Table core CSS    -->
        <link href="/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="/assets/css/demo.css" rel="stylesheet" />

    <head>
    <meta charset="UTF-8">
    </head>
    <style type="text/css">
        *{
            font-size: 9px;
        }
    </style>
    <div class="container">
        <h1>Reporte Diario Contable</h1>
        <table class="table">
                <thead>
                    <tr>
                        <th>tipo_documento</th>
                        <th>sucursal</th>
                        <th>numero_documento</th>
                        <th>prefijo</th>
                        <th>valor_transaccion</th>
                        <th>tipo_transaccion</th>
                        <th>cuenta</th>
                        <th>descripcion</th>
                        <th>tercero</th> 
                        <th>razon_social</th>
                        <th>fecha_documento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $obj)
                    <tr>
                            <td>{{ $obj['tipo_documento'] }}</td>
                            <td>{{ $obj['sucursal'] }}</td>
                            <td>{{ $obj['numero_documento'] }}</td>
                            <td>{{ $obj['prefijo'] }}</td>
                            <td>{{ $obj['valor_transaccion'] }}</td>
                            <td>{{ $obj['tipo_transaccion'] }}</td>
                            <td>{{ $obj['cuenta'] }}</td>
                            <td>{{ $obj['descripcion'] }}</td>
                            <td>{{ $obj['tercero'] }}</td> 
                            <td>{{ $obj['razon_social'] }}</td>
                            <td>{{ $obj['fecha_documento'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
