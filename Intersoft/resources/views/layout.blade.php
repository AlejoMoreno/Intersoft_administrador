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

    <script src="/assets/js/sweetalert.min.js"></script>

    

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


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    



    <style>
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
    </style>

</head>




<?php 

use App\Documentos;
$documentos = Documentos::where('ubicacion','=','ENTRADA')
                        ->where('id_empresa','=',Session::get('id_empresa'))->get();

$documentosSalida = Documentos::where('ubicacion','=','SALIDA')->
                        where('id_empresa','=',Session::get('id_empresa'))->get();

?>


<body onbeforeunload="config.leave_page()" style="background:#ededed;">

    <?php 

    $lista = null;
    if(Session::get('cargo') == "Administrador" || Session::get('cargo') == "admin" || Session::get('cargo') == "Admin"){
        $lista = ["Inicio", "Directorio", "Inventario", "Producción", "Facturación", "Tesorería", "Contabilidad", "Parámetros", "Salida"];
    }
    if(Session::get('cargo') == "Ventas" || Session::get('cargo') == "venta" || Session::get('cargo') == "Vendedor"){
        $lista = ["Inicio", "Directorio", "Producción", "Facturación", "Tesorería", "Salida"];
    }
    if(Session::get('cargo') == "Obrero" || Session::get('cargo') == "obrero" || Session::get('cargo') == "Obrero"){
        $lista = ["Inicio", "Inventario", "Producción", "Salida"];
    }

    ?>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default fondo-dinamico">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img style="width: 100px;" src="/assets/img/logo_intersoft1.png"></a>
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
                            <li><a href="javascript:;" onclick="config.Redirect('/administrador/index');">Parámetros</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/administrador/directorios');">Creación, Consulta, Directorio</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/calendario');">Calendario</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/administrador/usuarios');">Usuarios</a></li>
                        </ul>
                    </a>
                </li>
            <?php } ?>

            <?php if(in_array("Inventario",$lista)){ ?>
                <li class="inventario" id="inventario">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Inventario
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/referencias');">Maestro de Referencias</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/lotes');">Maestro de Lotes</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/catalogo');">Catálogo</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/kardex');">Tarjeta Kardex</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/kardex');">Costo Promedio Ponderado</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/actualizacionPrecios');">Actualización y Lista de Precios</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/kardex');">Presupuestos de Reposición</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/cierreInventario');">Cierre de Inventario</a></li>
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
                                        <?php $url = '/documentos/documento?signo='.$signo.'&nombre='.$obj['nombre'].'&id='.$obj['id'].'&prefijo='.$obj['prefijo'].'&numero='.$obj['num_presente']; ?>
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
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/fichatecnica');">Ficha técnica</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/materiaprima');">Inventario Materia Prima</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/ordenesdeproduccion');">Ordenes de Producción</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/liquidacionobra');">Liquidación Mano de Obra</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/costosdirectos');">Costos Directos</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/inventario/ingresoporproduccion');">Ingreso por producción</a></li>
                        </ul>
                    </a>
                </li>
            <?php } ?>

            <?php if(in_array("Facturación",$lista)){ ?>
                <li class="facturacion" id="facturacion">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Facturación
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;" onclick="config.Redirect('/facturacion/liquidacionventas');">Liquidación Comisiones</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/facturacion/estadisticaventas');">Estadistica Ventas</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/facturacion/zona');">Zonas Asingada</a></li>
                            <li role="separator" class="divider"></li>
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
                                        <?php $url = '/documentos/documento?signo='.$signo.'&nombre='.$obj['nombre'].'&id='.$obj['id'].'&prefijo='.$obj['prefijo'].'&numero='.$obj['num_presente']; ?>
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

            <?php if(in_array("Tesorería",$lista)){ ?>
                <li class="tesoreria" id="tesoreria">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Tesorería
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;" onclick="config.Redirect('/cartera/gastos');">Control de Gastos</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/cartera/otrosingresos');">Otros Ingresos</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/cartera/egresos');">Pago a Proveedores</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/cartera/ingresos');">Cobro Cartera</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/cartera/cheques');">Cheques</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/cartera/Importaciones');">Pago Importaciones</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/cartera/pagoobligaciones');">Retefuente, Iva, Reteica</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/cartera/extracto');">Extracto y Cuentas de Cobro</a></li>
                            <li><a href="javascript:;" onclick="config.Redirect('/cartera/Causaciones');">Causaciones</a></li>
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
                <a href="#">
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


    <div class="content row" style="background:#ededed;">
        @if(Session::has('user_id'))
        <section class="col-md-10 row">
            <article class="col-md-12">
                <!-- INICIO ARTICULO -->
                @yield('content')
                <!-- FIN ARTICULO -->
            </article>
        </section>
        @else
        <section class="col-md-10 row">
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
    
    <!-- FORTER ENTER-->
    <footer class="footer">
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
            <img style="width: 20%;maring-left:20%" src="/assets/img/logo_intersoft1.png">
            <p class="copyright pull-right">
                &copy; <script>document.write(new Date().getFullYear())</script> <a href="https://wakusoft.com">wakusoft.com</a>, derechos reservados
            </p>
        </div>
    </footer>
    <!-- FORTER FIN-->


<div id="resultado" style="display:none;position:fixed;width: 100%;height: 100%;background:black;opacity:0.5;z-index:1000;"><div class="loader"></div></div>


<script>
    let menu = ["inventario","index","salida","cartera","contabilidad","calendario","administrador"];
    for(let i = 0; menu.length > i; i++){
        if(menu[i] == window.location.pathname.split('/')[1]){
            document.getElementById(menu[i]).classList.add("active");
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



</body>

</html>