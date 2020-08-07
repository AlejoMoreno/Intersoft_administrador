<html>

<body>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet"  />
    <?php $empresa = App\Empresas::where('id','=',Session::get('id_empresa'))->first(); ?>
    <?php $lineas = App\Lineas::where('id_empresa','=',Session::get('id_empresa'))->get(); ?>
    <div class="jumbotron text-center">
        <h1>Catalogo de productos</h1>
        <h2>{{ $empresa->razon_social }}</h2>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($lineas as $linea)
            <div class="col-sm-12" style="text-align: center;">
                <h3>{{ $linea->nombre }}</h3>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Precio 1</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $ref)
                            @if($linea->id == $ref['codigo_linea'])
                            <tr>
                                <td style="text-align: left">{{ $ref['codigo_barras'] }}</td>
                                <td style="text-align: left">{{ $ref['descripcion'] }}</td>
                                <td style="text-align: right">{{ $ref['precio'] }}</td>
                            </tr>
                            @endif
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            @endforeach
        </div>
    </div>

</body>

</html>
