<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="icon" type="image/png" href="/assets/1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Intersoft</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <!-- Bootstrap core CSS     -->
        <link href="{{ public_path('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    
        <link  href="{{ public_path('assets/css/pdfstyle.css') }}" rel="stylesheet"/>
    </head>
        <div class="container">
            <h1>Referencias</h1>
            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>nit</th> 
                            <th>digito</th>
                            <th>razon_social</th>
                            <th>direccion</th>
                            <th>ciudades</th>
                            <th>telefono</th>
                            <th>correo</th>
                            <th>calificacion</th>
                            <th>retefuentes</th>
                            <th>regimenes</th>
                            <th>tipo terceros</th>
                            <th>clases</th>
                            <th>estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $obj)
                        <tr>
                                <td>{{ $obj['nit'] }}</td>
                                <td>{{ $obj['digito'] }}</td>
                                <td>{{ $obj['razon_social'] }}</td>
                                <td>{{ $obj['direccion'] }}</td>
                                <td>{{ $obj['id_ciudad'] }}</td>
                                <td>{{ $obj['telefono'] }}</td>
                                <td>{{ $obj['correo'] }}</td>
                                <td>{{ $obj['calificacion'] }}</td>
                                <td>{{ $obj['id_retefuente'] }}</td>
                                <td>{{ $obj['id_regimen'] }}</td>
                                <td>{{ $obj['id_directorio_tipo_tercero'] }}</td>
                                <td>{{ $obj['id_directorio_clase'] }}</td> 
                                <td>{{ $obj['estado'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>