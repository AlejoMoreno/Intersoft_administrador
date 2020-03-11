<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="http://wakusoft.com/img/works/thumbs/1.png">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- TEXT EDTIT -->
    <!--script src="https://imperavi.com/assets/redactor/redactor.js?v"></script>-->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    

    <!-- CSS FAMC -->
    <link rel="stylesheet" href="/css/menu.css">
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


    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
    /*var OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
        appId: "0f1b955e-ce5f-41b7-b75d-daa385e4e52a",
        notifyButton: {
            enable: true,
        },
        });
    });*/
    </script>

</head>
<body onbeforeunload="config.leave_page()">
<div id="resultado" style="display:none;position:fixed;width: 100%;height: 100%;background:black;opacity:0.5;z-index:1000;"><div class="loader"></div></div>
<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="/assets/img/sidebar-1.jpg" style="overflow-x:hidden">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="dashboard.html" class="simple-text">
                     Intersoft
                </a>
            </div>

            <ul class="nav">
                <li class="index" id="index">
                    <a href="#" onclick="config.Redirect('/index');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/204/204366.svg">
                        <p>Inicio</p>
                    </a>
                </li>
                <li class="directorio" id="directorio">
                    <a href="#" onclick="config.Redirect('/submenu/directorio');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/2245/2245320.svg">
                        <p>Directorio</p>
                    </a>
                </li>
                <li class="inventario" id="inventario">
                    <a href="#" onclick="config.Redirect('/submenu/inventario');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/1924/1924873.svg">
                        <p>Inventario</p>
                    </a>
                </li>
                <li class="produccion" id="produccion"> 
                    <a href="#" onclick="config.Redirect('/submenu/produccion');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/2166/2166907.svg">
                        <p>Producción</p>
                    </a>
                </li>
                <li class="facturacion" id="facturacion">
                    <a href="#" onclick="config.Redirect('/submenu/facturacion');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/138/138360.svg">
                        <p>Facturación</p>
                    </a>
                </li>
                <li class="tesoreria" id="tesoreria">
                    <a href="#" onclick="config.Redirect('/submenu/tesoreria');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/1162/1162498.svg">
                        <p>Tesorería</p>
                    </a>
                </li>
                <li class="contabilidad" id="contabilidad">
                    <a href="#" onclick="config.Redirect('/submenu/contabilidad');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/313/313062.svg">
                        <p>Contabilidad</p>
                    </a>
                </li>
                <li id="administrador">  
                    <a href="#" onclick="config.Redirect('/administrador/index');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/148/148912.svg">
                        <p>Parámetros</p>
                    </a>
                </li>
                <li id="Salida">  
                    <a href="#" onclick="config.Redirect('/cerrar');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/529/529873.svg">
                        <p>Salida</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>
    <div class="main-panel">

        <script>
        //$("#mostrar").hide();
        toogle();
        function toogle(){
            $(".sidebar-wrapper").css("width","260px");
            $(".sidebar").css("width","75px");
            $(".main-panel").css("width","calc(100% - 75px)");
            $("#ocultar").hide();
            $("#mostrar").show();
        }
        function toogle1(){
            $(".sidebar-wrapper").css("width","260px");
            $(".sidebar").css("width","260px");
            $(".main-panel").css("width","calc(100% - 260px)");
            $("#mostrar").hide();
            $("#ocultar").show();
        }
        </script>

        @if(Session::has('user_id'))
        <!-- CONTENT ENTER-->
        <div class="content">
            @yield('content')
        </div>
        <!-- CONTENT FIN-->
        @else
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Error de sesión, vuelve a ingresar</h4>
                                <p class="category"><a href="/">Por favor ingresa Aqui</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        

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
                        <?php $empresa = App\Empresas::where('id','=',Session::get('id_empresa'))->first(); ?>
                            <small><strong>Nombre: </strong>{{ Session::get('nombre') }}</small> <br>
                            <small><strong>Cargo: </strong>{{ Session::get('cargo') }}</small> <br>
                            <small><strong>Empresa: </strong>{{ $empresa->razon_social }}</small> <br>
                            <small><strong>Sucursal: </strong>{{ Session::get('sucursalNombre') }}</small>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="https://wakusoft.com">wakusoft.com</a>, derechos reservados
                </p>
            </div>
        </footer>
        <!-- FORTER FIN-->

        <script type="text/javascript">
            $('#perfil').html("<small>" + localStorage.getItem("Nombre") + " " + localStorage.getItem("Apellido") + " || " + localStorage.getItem("Cargo") + "</small>");
        </script>

    </div>
</div>

<style type="text/css">
.sidebar-wrapper::-webkit-scrollbar-track,.main-panel::-webkit-scrollbar-track
{
    background-color: #F5F5F5;
}

.sidebar-wrapper::-webkit-scrollbar, .main-panel::-webkit-scrollbar
{
    width: 5px;
    background-color: #F5F5F5;
}

.sidebar-wrapper::-webkit-scrollbar-thumb, .main-panel::-webkit-scrollbar-thumb
{
    background-color: #176dca;  
}

</style>

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
<style>



</body>

</html>