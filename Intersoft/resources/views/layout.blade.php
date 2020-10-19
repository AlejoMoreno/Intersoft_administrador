<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="/assets/img/logo_intersoft.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Intersoft</title>
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
    <!--  CSS for animated     -->
    <link href="/assets/css/animate.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400&display=swap" rel="stylesheet">
    <link href="/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>
	<script src="/assets/js/jquery.min3.js"></script>
    <!-- TEXT EDTIT -->
    <!--script src="https://imperavi.com/assets/redactor/redactor.js?v"></script>-->


    

    <!-- CSS FAMC -->
    <!--<link rel="stylesheet" href="/css/menu.css">-->
    <!-- SCRIPTS FAMC -->
    <script type="text/javascript" src="/js/config.js"></script>
    <script type="text/javascript" src="/js/texto.js"></script>
    <script type="text/javascript" src="/js/DB/sesion.js"></script>
    <script type="text/javascript" src="/js/perfil.js"></script>
    <script type="text/javascript" src="/js/marcas.js"></script>
    <script type="text/javascript" src="/js/lineas.js"></script>
    <script type="text/javascript" src="/js/usuarios.js"></script>
    <script type="text/javascript" src="/js/productos.js"></script>
    <script type="text/javascript" src="/js/ciudades.js"></script>

    <script type="text/javascript" src="/js/administrador/directorios.js"></script>
    <script type="text/javascript" src="/js/administrador/sucursales.js"></script>
    <script type="text/javascript" src="/js/administrador/usuarios.js"></script>
    <script type="text/javascript" src="/js/administrador/tipopagos.js"></script>

    <script type="text/javascript" src="/js/inventario/clasificaciones.js"></script>
    <script type="text/javascript" src="/js/inventario/tipo_presentacion.js"></script>
    <script type="text/javascript" src="/js/inventario/lineas.js"></script>
    <script type="text/javascript" src="/js/inventario/marcas.js"></script>
    <script type="text/javascript" src="/js/inventario/referencias.js"></script>
    <script type="text/javascript" src="/js/inventario/documentos.js"></script>
    <script type="text/javascript" src="/js/inventario/lotes.js"></script>

    <script type="text/javascript" src="/js/contabilidad/cuentas.js"></script>

    <script type="text/javascript" src="/js/cartera/index.js"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script>try{Modernizr} catch(e) {document.write('<script src="./assets/js/vendor/modernizr-2.8.3.min.js"><\/script>')}</script>
    <!-- https://leafletjs.com/examples.html GOOGLE MAPS API LEAFLETSJS-->
    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <link rel="stylesheet" href="/assets/leafletjs/leaflet-routing-machine.css">
    <script src="/assets/leafletjs/leaflet-routing-machine.js"></script>

    <link rel="stylesheet" href="/js/Toastada-master/demo/index.css" media="screen">
    


    <style>
        i{
            font-size: 18pt;
        }
        .no-geolocation .box { color: red; }
        .geolocation .box { color: green; }
        .navbar-default .navbar-nav > li > a:not(.btn) {
            color: white;
        }
        .navbar-default .navbar-nav > li > a:not(.btn):hover,.navbar-default .navbar-nav > li > a:not(.btn):focus{
            color: black !important;
        }
        .fondo-dinamico{
            -webkit-animation: pantallain 100s infinite; /* Safari 4.0 - 8.0 */
			-webkit-animation-direction: alternate; /* Safari 4.0 - 8.0 */
			animation: pantallain 100s infinite;
			animation-direction: alternate;
		}
		/* Safari 4.0 - 8.0 */
		@-webkit-keyframes pantallain {
			0%   {background: #022c76;}
			50%  {background: #5abd61;}
			100%  {background: #022c76;} 
		}
		
		@keyframes pantallain {
			0%   {background: #022c76;}
			50%  {background: #5abd61;}
			100%  {background: #022c76;} 
        }
        section{
            background: #ededed;
        }
        article{
            margin:5%;
            margin-top:2%;
            padding: 5%;
            background: white;
            -webkit-box-shadow: 0px 0px 5px 0px rgba(158,158,158,1);
            -moz-box-shadow: 0px 0px 5px 0px rgba(158,158,158,1);
            box-shadow: 0px 0px 5px 0px rgba(158,158,158,1);
        }
        @media (max-width: 991px){
            .navbar .navbar-collapse.collapse, .navbar .navbar-collapse.collapse.in, .navbar .navbar-collapse.collapsing {
                display: inline !important;
            }
        }


        .enc-article{
            background: white;
            position: absolute;
            top:0px;
            left:0px;
            width: 100%;
            -webkit-animation: tituloart 20s infinite; /* Safari 4.0 - 8.0 */
            -webkit-animation-direction: alternate; /* Safari 4.0 - 8.0 */
            animation: tituloart 20s infinite;
            animation-direction: alternate;
            border: 0px;
            border-bottom: 1pt solid #ededed;
        }
        /* Safari 4.0 - 8.0 */
        @-webkit-keyframes tituloart {
            0%   {background: #f7f7f7;}
            100%  {background: #ededed;} 
        }

        @keyframes tituloart {
            0%   {background: #f7f7f7;}
            100%  {background: #ededed;} 
        }
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .preloader {
            width: 70px;
            height: 70px;
            border: 10px solid #eee;
            border-top: 10px solid #666;
            border-radius: 50%;
            animation-name: girar;
            animation-duration: 2s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
            }
            @keyframes girar {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .title{
            margin-left: 2%;
            font-weight: bold;
            font-family: Poppins;
        }
        .top-5-w{
            margin-top:5%;
        }
        .table > thead th {
            -webkit-animation: pantallain 100s infinite; /* Safari 4.0 - 8.0 */
            -webkit-animation-direction: alternate; /* Safari 4.0 - 8.0 */
            animation: pantallain 100s infinite;
            animation-direction: alternate;
        }
        
        .panel-warning{
            border: 1px solid #022c76;
            border-radius: 0%;
            margin-top: 3.5%;
            margin-left: 3%;
        }
        .panel-warning .panel-heading{
            background: #022c76;
            border-radius: 0%;
            color: white;
        }
        .panel-default{
            border: 1px solid #3c763d;
            border-radius: 0%;
            margin-top: 2%;
        }
        .panel-default .panel-heading{
            background: #3c763d;
            border-radius: 0%;
            color: white;
        }

        .btn-actualizar, .btn-guardar, .btn-nuevo, .btn-buscar{
            background: white;
            border-radius: 0%;
            opacity: 1;
            padding:1%;
            margin: 1%;
            font-size: 11px;
        }

        .pregunta{
            background: black;
            opacity: 0.7;
            color:white;
            font-size: 10px;
            padding:5px;
            border-radius: 100%;
            cursor: -webkit-grab; 
            cursor: grab;
        }
    </style>

</head>


<body onbeforeunload="config.leave_page()" style="background:#ededed;overflow-x:hidden;">
    

    <div id="resultado" style="display:none;position:fixed;width: 100%;height: 100%;background:black;opacity:0.5;z-index:1000;top:0px;left:0px;"><div class="loader"></div></div>

    <?php 
    use App\Documentos;
    if(Session::has('cargo')){
        
        $documentos = Documentos::where('ubicacion','=','ENTRADA')
                                ->where('id_empresa','=',Session::get('id_empresa'))->get();

        $documentosSalida = Documentos::where('ubicacion','=','SALIDA')->
                                where('id_empresa','=',Session::get('id_empresa'))->get();

        date_default_timezone_set('America/Bogota');
        $hora = date('Hi');
        $hora_limite = date('1600');
        $dif = $hora_limite - $hora;

        $lista = null;
        if(Session::get('cargo') == "Administrador" || Session::get('cargo') == "admin" || Session::get('cargo') == "Admin"){
            $lista = ["Inicio", "Directorio", "Inventario", "Producción", "Facturación", "Tesorería", "Contabilidad", "Parámetros", "Salida"];
            $Directorio = ['Parámetros','Creación, Consulta, Directorio','Calendario','Usuarios'];
            $Inventario = ['Maestro de Referencias','Maestro de Lotes','Catálogo','Tareta Kardex','Costo Promedio Ponderado','Actualización y Lista de Precios','Presupuestos de Reposición','Cierre de inventario','Alistamiento'];
            $Produccion = ['Ficha técnica','Inventario Materia Prima','Ordenes de Producción','Liquidación Mano de Obra','Costos Directos','Ingreso por producción'];
            $Facturacion = ['Liquidación Comisiones','Estadistica Ventas','Zonas Asingada','Pasar PEDIDOS a FACTURA','DEVOLUCIONES','Facturatech'];
            $Tesoreria = ['Control de Gastos','Otros Ingresos','Pago a Proveedores','Cobro Cartera','Cheques','Pago Importaciones','Retefuente, Iva, Reteica','Extracto y Cuentas de Cobro','Causaciones','Reportes'];
        }
        else if(Session::get('cargo') == "Ventas" || Session::get('cargo') == "venta" || Session::get('cargo') == "Vendedor"){
            $lista = ["Inicio", "Directorio", "Facturación", "Salida"];
            $Facturacion = ['Estadistica Ventas','Facturatech'];
            $Directorio = ['Creación, Consulta, Directorio'];
            
        }
        else if(Session::get('cargo') == "Inventario" || Session::get('cargo') == "Inventario" || Session::get('cargo') == "Inventario"){
            $lista = ["Inicio", "Inventario", "Producción", "Facturación", "Salida"];
            $Inventario = ['Maestro de Referencias','Maestro de Lotes','Catálogo','Tareta Kardex','Costo Promedio Ponderado','Actualización y Lista de Precios','Presupuestos de Reposición','Cierre de inventario','Alistamiento'];
            $Produccion = ['Ficha técnica','Inventario Materia Prima','Ordenes de Producción','Liquidación Mano de Obra','Costos Directos','Ingreso por producción'];
            $Facturacion = ['Estadistica Ventas','Facturatech'];
        }
        else if(Session::get('cargo') == "Recursos Humanos" || Session::get('cargo') == "Recursos Humanos" || Session::get('cargo') == "Recursos Humanos"){
            $lista = ["Inicio", "Directorio", "Facturación", "Tesorería", "Salida"];
            $Directorio = ['Parámetros','Creación, Consulta, Directorio','Calendario','Usuarios'];
            $Tesoreria = ['Control de Gastos','Otros Ingresos','Pago a Proveedores','Cobro Cartera','Cheques','Pago Importaciones','Retefuente, Iva, Reteica','Extracto y Cuentas de Cobro','Causaciones','Reportes'];
            $Facturacion = ['Estadistica Ventas','Zonas Asingada','Facturatech'];
        }
    }
    

    ?>

    <!-- Fixed navbar -->
    @if(Session::has('cargo'))
    <nav class="navbar navbar-default fondo-dinamico">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img style="width: 40px;margin-top:-10px;" src="/assets/img/logo_intersot.png"></a>
          {{ $dif }}
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            
          <?php if(in_array("Inicio",$lista)){ ?>

            <li class="index" id="index">
                <a href="#" onclick="config.Redirect('/index');">
                    Inicio
                </a>
            </li>

            <?php } ?>

            <?php if(in_array("Directorio",$lista)){ ?>
                <li class="directorio" id="directorio">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Directorio
                        <ul class="dropdown-menu">
                            <?php if(in_array("Parámetros",$Directorio)){ ?><li><a href="javascript:;" onclick="config.Redirect('/administrador/index');">Parámetros</a></li><?php } ?>
                            <?php if(in_array("Creación, Consulta, Directorio",$Directorio)){ ?><li><a href="javascript:;" onclick="config.Redirect('/administrador/directorios');">Creación, Consulta, Directorio</a></li><?php } ?>
                            <?php if(in_array("Calendario",$Directorio)){ ?><li><a href="javascript:;" onclick="config.Redirect('/calendario');">Calendario</a></li><?php } ?>
                            <?php if(in_array("Usuarios",$Directorio)){ ?><li><a href="javascript:;" onclick="config.Redirect('/administrador/usuarios');">Usuarios</a></li><?php } ?>
                        </ul>
                    </a>
                </li>
            <?php } ?>

            <?php if(in_array("Inventario",$lista)){ ?>
                <li class="inventario" id="inventario">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Inventario
                        <ul class="dropdown-menu">
                            <?php if(in_array("Maestro de Referencias",$Inventario)){ ?><li><a href="javascript:;" onclick="config.Redirect('/inventario/referencias');">Maestro de Referencias</a></li><?php } ?>
                            <?php if(in_array("Maestro de Lotes",$Inventario)){ ?><li><a href="javascript:;" onclick="config.Redirect('/inventario/lotes');">Maestro de Lotes</a></li><?php } ?>
                            <?php if(in_array("Catálogo",$Inventario)){ ?><li><a href="javascript:;" onclick="config.Redirect('/inventario/catalogo');">Catálogo</a></li><?php } ?>
                            <?php if(in_array("Tarjeta Kardex",$Inventario)){ ?><li><a href="javascript:;" onclick="config.Redirect('/inventario/kardex');">Tarjeta Kardex</a></li><?php } ?>
                            <?php if(in_array("Actualización y Lista de Precios",$Inventario)){ ?><li><a href="javascript:;" onclick="config.Redirect('/inventario/actualizacionPrecios');">Actualización y Lista de Precios</a></li><?php } ?>
                            <?php if(in_array("Cierre de Inventario",$Inventario)){ ?><li><a href="javascript:;" onclick="config.Redirect('/inventario/cierreInventario');">Cierre de Inventario</a></li><?php } ?>
                            <?php if(in_array("Alistamiento",$Inventario)){ ?><li><a href="javascript:;" onclick="config.Redirect('/facturacion/alistamiento');">Alistamiento</a></li><?php } ?>
                            <li role="separator" class="divider"></li>
                            @foreach ($documentos as $obj)
                                <?php 
                                if($obj["signo"]=='+'){
                                    $signo = "mas";
                                }
                                elseif($obj["signo"]=='-'){
                                    $signo = "menos";
                                }
                                else{
                                    $signo = "igual";
                                }
                                ?> 
                                <li>
                                    <div class="row">
                                        <?php $url = '/facturacion/compra/'.$obj['id']; ?>
                                        <a class="col-md-7" style="margin-left:6%;" href="{{ $url }}" target="_blank">{{ $obj['nombre'] }}</a>
                                        <?php $urlconsulta = '/documentos/consultar/'.$obj['id']; ?>
                                        <a class="col-md-2" href="{{ $urlconsulta }}" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    <div>
                                </li>
                                <li role="separator" class="divider"></li>
                            @endforeach
                        </ul>
                    </a>
                </li>
            <?php } ?>

            <?php if(in_array("Producción",$lista)){ ?>
                <li class="produccion" id="produccion"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Producción
                        <ul class="dropdown-menu">
                            <?php if(in_array("Ficha técnica",$Produccion)){ ?><li><a href="javascript:;" onclick="config.Redirect('/inventario/fichatecnica');">Ficha técnica</a></li><?php } ?>
                            <?php if(in_array("Inventario Materia Prima",$Produccion)){ ?><li><a href="javascript:;" onclick="config.Redirect('/inventario/materiaprima');">Inventario Materia Prima</a></li><?php } ?>
                            <?php if(in_array("Ordenes de Producción",$Produccion)){ ?><li><a href="javascript:;" onclick="config.Redirect('/inventario/ordenesdeproduccion');">Ordenes de Producción</a></li><?php } ?>
                            <?php if(in_array("Liquidación Mano de Obra",$Produccion)){ ?><li><a href="javascript:;" onclick="config.Redirect('/inventario/liquidacionobra');">Liquidación Mano de Obra</a></li><?php } ?>
                            <?php if(in_array("Costos Directos",$Produccion)){ ?><li><a href="javascript:;" onclick="config.Redirect('/inventario/costosdirectos');">Costos Directos</a></li><?php } ?>
                            <?php if(in_array("Ingreso por producción",$Produccion)){ ?><li><a href="javascript:;" onclick="config.Redirect('/inventario/ingresoporproduccion');">Ingreso por producción</a></li><?php } ?>
                        </ul>
                    </a>
                </li>
            <?php } ?>

            <?php if(in_array("Facturación",$lista)){ ?>
                <li class="facturacion" id="facturacion">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Facturación
                        <ul class="dropdown-menu">
                            <?php if(in_array("Liquidación Comisiones",$Facturacion)){ ?><li><a href="javascript:;" onclick="config.Redirect('/facturacion/liquidacionventas');">Liquidación Comisiones</a></li><?php } ?>
                            <?php if(in_array("Estadistica Ventas",$Facturacion)){ ?><li><a href="javascript:;" onclick="config.Redirect('/facturacion/estadisticaventas');">Estadistica Ventas</a></li><?php } ?>
                            <?php if(in_array("Zonas Asingada",$Facturacion)){ ?><li><a href="javascript:;" onclick="config.Redirect('/facturacion/zona');">Zonas Asingada</a></li><?php } ?>
                            <?php if(in_array("Facturatech",$Facturacion)){ ?><li><a href="javascript:;" onclick="config.Redirect('/facturacion/facturatech');">Facturatech</a></li><?php } ?>                            
                            <li role="separator" class="divider"></li>
                            <?php if(in_array("Pasar PEDIDOS a FACTURA",$Facturacion)){ ?><li><div><a href="javascript:;" style="margin-left:8%" onclick="config.Redirect('/facturacion/pedidos');">Pasar PEDIDOS a FACTURA</a></div></li><?php } ?>
                            <li role="separator" class="divider"></li>
                            <?php if(in_array("DEVOLUCIONES",$Facturacion)){ ?><li><div><a href="javascript:;" style="margin-left:8%" onclick="config.Redirect('/facturacion/devoluciones');">DEVOLUCIONES</a></div></li><?php } ?>
                            <li role="separator" class="divider"></li>
                            @if( true )
                                @foreach ($documentosSalida as $obj)
                                    <?php 
                                    if($obj["signo"]=='+'){
                                        $signo = "mas";
                                    }
                                    elseif($obj["signo"]=='-'){
                                        $signo = "menos";
                                    }
                                    else{
                                        $signo = "igual";
                                    }
                                    if($obj['nombre']=="MAYORISTA"){
                                        $num  = $obj['num_presente'];
                                    }
                                    ?> 
                                    <li>
                                        <div class="row">
                                            <?php $url = '/facturacion/venta/'.$obj['id']; ?>
                                            <a class="col-md-7" style="margin-left:6%;" href="{{ $url }}" target="_blank">{{ $obj['nombre'] }}</a>
                                            <?php $urlconsulta = '/documentos/consultar/'.$obj['id']; ?>
                                            <a class="col-md-2" href="{{ $urlconsulta }}" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></a>
                                        <div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                @endforeach
                            @endif
                        </ul>
                    </a>
                </li>
            <?php } ?>

            <?php if(in_array("Tesorería",$lista)){ ?>
                <li class="tesoreria" id="tesoreria">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Tesorería
                        <ul class="dropdown-menu">
                            <?php if(in_array("Control de Gastos",$Tesoreria)){ ?><li><a href="javascript:;" onclick="config.Redirect('/cartera/gastos');">Control de Gastos</a></li><?php } ?>
                            <?php if(in_array("Otros Ingresos",$Tesoreria)){ ?><li><a href="javascript:;" onclick="config.Redirect('/cartera/otrosingresos');">Otros Ingresos</a></li><?php } ?>
                            <?php if(in_array("Pago a Proveedores",$Tesoreria)){ ?><li><a href="javascript:;" onclick="config.Redirect('/cartera/egresos');">Pago a Proveedores</a></li><?php } ?>
                            <?php if(in_array("Cobro Cartera",$Tesoreria)){ ?><li><a href="javascript:;" onclick="config.Redirect('/cartera/ingresos');">Cobro Cartera</a></li><?php } ?>
                            <?php if(in_array("Extracto y Cuentas de Cobro",$Tesoreria)){ ?><li><a href="javascript:;" onclick="config.Redirect('/cartera/extracto');">Extracto y Cuentas de Cobro</a></li><?php } ?>
                            <?php if(in_array("Reportes",$Tesoreria)){ ?><li><a href="javascript:;" onclick="config.Redirect('/reporte');">Reportes</a></li><?php } ?>
                        </ul>
                    </a>
                </li>
            <?php } ?>

            <?php if(in_array("Contabilidad",$lista)){ ?>
                <li class="contabilidad" id="contabilidad">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Contabilidad
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;" onclick="config.Redirect('/contabilidad/cuentas');">PUC</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/contabilidad/comprobantesdiario');">Comprobantes de Diario</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/contabilidad/librosauxiliares');">Libros Auxiliares</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/contabilidad/librosmayores');">Libros Mayores</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/contabilidad/balancecomprobacion');">Balance de Comprobación</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/contabilidad/perdidasganancias');">Perdidas y Ganancias</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/contabilidad/analisismensual');">Análisis Mensual Gastos</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/contabilidad/mediosmagneticos');">Medios Magnéticos</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/contabilidad/balancegeneral');">Balance General</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/contabilidad/certificados');">Certificados</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/contabilidad/liquidacionimpuestos');">Liquidación Impuestos</a></li>
                        </ul>
                    </a>
                </li>
            <?php } ?>

            <?php if(in_array("Parámetros",$lista)){ ?>
                <li id="administrador">  
                    <a href="#" onclick="config.Redirect('/administrador/index');">
                        Parámetros
                    </a>
                </li>
            <?php } ?>

            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>-->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            

            <li id="Salida">  
                <a href="/contrasena">
                    </strong>{{ Session::get('nombre') }} / {{ Session::get('cargo') }}</small>
                </a>
            </li>

            <?php if(in_array("Salida",$lista)){ ?>
                <li id="Salida">  
                    <a href="#" onclick="config.Redirect('/cerrar');">
                        <img style="float: left;" width="20" src="/assets/529873.svg">
                    </a>
                </li>
            <?php } ?>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    @endif

    @if(Session::has('cargo'))
    <div class="content row" style="background:#ededed;">
        @if(Session::has('user_id'))
        <section class="col-md-11 row">
            <article class="col-md-12">
                <!-- INICIO ARTICULO -->
                @yield('content')
                <!-- FIN ARTICULO -->
            </article>
        </section>
        @else
        <section class="col-md-12 row">
            <article class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Error de sesión, vuelve a ingresar</h4>
                        <p class="category"><a href="/">Por favor ingresa Aqui</a></p>
                    </div>
                </div>
            </article>
        </section>
        @endif
    </div>
    
    <div style="width:100%;">
        <!-- FORTER ENTER-->
        <div class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Manual
                            </a>
                        </li>
                        <li>
                            <a href="https://wakusoft.com">
                                Terminos y Condiciones
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <?php $empresa = App\Empresas::where('id','=',Session::get('id_empresa'))->first(); ?>
                                <small><strong>Empresa: </strong>{{ $empresa->razon_social }}</small>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <small><strong>Sucursal: </strong>{{ Session::get('sucursalNombre') }}</small>
                            </a>
                        </li>
                    </ul>
                </nav>
                <img style="width: 100px;" src="/assets/img/logo_intersoft1.png">
                <img style="width: 100px;" src="http://intersoft.wakusoft.com/assets/img/empresas/{{ Session::get('id_empresa') }}.jpeg">
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="https://wakusoft.com">wakusoft.com</a>, derechos reservados
                </p>
            </div>
        </div>
        <!-- FORTER FIN-->
    </div>
    @else
    <section class="col-md-12 row">
        <article class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Error de sesión, vuelve a ingresar</h4>
                    <p class="category"><a href="/">Por favor ingresa Aqui para volver a iniciar sesion</a></p>
                </div>
            </div>
        </article>
    </section>
    @endif






<script>
    let menu = ["inventario","index","salida","cartera","contabilidad","calendario","administrador"];
    for(let i = 0; menu.length > i; i++){
        if(menu[i] == window.location.pathname.split('/')[1]){
            document.getElementById(menu[i]).classList.add("active");
        }
    }

    $(document).ready(function(){
        //getLocation();
    });

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, positionError, { enableHighAccuracy: true, maximumAge: 60000, timeout: 10000 });        
        } 
        else { 
            if (Modernizr.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, positionError, { enableHighAccuracy: true, maximumAge: 60000, timeout: 10000 });
            } else {
                console.log("ERROR. Ocurrio algo con la geolocalización");
            }
        }
    }

    function showPosition(position) {
      console.log(position.coords);
      
      var urls = "/gps/trakingmaps";
        parametros = {
            "longitud" : position.coords.longitude,
            "latitud" : position.coords.latitude,
            "accuracy" : "0"
        };
        $.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
                $('#resultado').html('<div style="margin-top:27%;margin-left:45%;" class="preloader"></div>');
            },
            success:  function (response) {
                console.log(response);
            },
            error: function(){
                console.log("error");
            }
        });
    }

    function positionError(error)
    {
        var message = "";

        // Check for known errors
        switch (error.code) {
            case error.PERMISSION_DENIED:
                message = "This website does not have your permission to use the Geolocation API";
                break;
            case error.POSITION_UNAVAILABLE:
                message = "Your current position could not be determined.";
                break;
            case error.PERMISSION_DENIED_TIMEOUT:
                message = "Your current position could not be determined within the specified timeout period.";
                break;
        }

        // If it's an unknown error, build a message that includes 
        // information that helps identify the situation, so that 
        // the error handler can be updated.
        if (message == "") {
            var strErrorCode = error.code.toString();
            message = "Your position could not be determined due to " +
                      "an unknown error (Code: " + strErrorCode + ").";
        }

    }
    
</script>

<style>
    .card{
        background: #ebe9f9;
    }
    .header{
        background: #207ce5;
        color:white;
    }
    .card .title, .card .category{
        color:white;
    }
    .table{
        background: white;
    }
    .table > thead th{
        background: #207ce5;
    }
    .table > thead > tr > th{
        color:white;
    }
    .content label{
        color:#207ce5;
        font-weight: bold;
    }
</style>


<style type="text/css">
@media print {
       .card{
        padding: 5%;
        background: #ebe9f9;
    }
    .header{
        padding: 5%;
        background: #207ce5;
        color:white;
    }
    .card .title, .card .category{
        color:white;
    }
    .content label{
        color:#207ce5;
        font-weight: bold;
    }
}
</style>

<script src="/js/Toastada-master/demo/index.js"></script>
<script src="/js/Toastada-master/demo/script.js"></script>

<script src="/assets/js/sweetalert.min.js"></script>

<script src="https://kit.fontawesome.com/27e74665ed.js" crossorigin="anonymous"></script>

<!--datatables functions-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>




</body>

</html>