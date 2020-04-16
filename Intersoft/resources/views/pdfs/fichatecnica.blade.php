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
        <h1>{{ $objs[0]->orden }} - {{ $objs[0]->nombre }}</h1>
        <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>referencia</th>
                        <th>cantidad</th>
                        <th>costo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($objs as $obj)
                    <tr>
                        <td>{{ $obj['id_referencia']['descripcion'] }}</td>
                        <td>{{ $obj['cantidad'] }}</td>
                        <td>{{ $obj['id_referencia']['costo_promedio'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>