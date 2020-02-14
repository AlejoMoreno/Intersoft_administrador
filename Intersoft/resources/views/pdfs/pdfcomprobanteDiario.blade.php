<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" type="image/png" href="http://wakusoft.com/img/works/thumbs/1.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Intersoft</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="{{ public_path('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <link  href="{{ public_path('assets/css/pdfstyle.css') }}" rel="stylesheet"/>
</head>
    <div class="container">
        <h1>Reporte Diario Contable</h1>
        <table class="table table-bordered">
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
