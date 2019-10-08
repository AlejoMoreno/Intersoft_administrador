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
    <link href="https://localhost:8000/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- TEXT EDTIT -->
    <link rel="stylesheet" href="https://imperavi.com/assets/redactor/redactor.min.css" />
    <!--script src="https://imperavi.com/assets/redactor/redactor.js?v"></script>-->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    

    <!-- CSS FAMC -->
    <link rel="stylesheet" href="/css/menu.css">
    <!-- SCRIPTS FAMC -->
    <script type="text/javascript" src="/js/config.js"></script>
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

    <script type="text/javascript" src="/js/inventario/clasificaciones.js"></script>
    <script type="text/javascript" src="/js/inventario/tipo_presentacion.js"></script>
    <script type="text/javascript" src="/js/inventario/lineas.js"></script>
    <script type="text/javascript" src="/js/inventario/marcas.js"></script>
    <script type="text/javascript" src="/js/inventario/referencias.js"></script>
    <script type="text/javascript" src="/js/inventario/documentos.js"></script>
    <script type="text/javascript" src="/js/inventario/lotes.js"></script>

    <script type="text/javascript" src="/js/contabilidad/cuentas.js"></script>

</head>
<body>

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
                <li class="inventario" id="inventario">
                    <a href="#" onclick="config.Redirect('/inventario/index');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/1924/1924873.svg">
                        <p>Entrada Inventario</p>
                    </a>
                </li>
                <li class="salida" id="salida">
                    <a href="#" onclick="config.Redirect('/salida/index');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/138/138360.svg">
                        <p>Salida Inventario</p>
                    </a>
                </li>
                <li class="cartera" id="cartera"> 
                    <a href="#" onclick="config.Redirect('/cartera/index');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/31/31368.svg">
                        <p>Cartera</p>
                    </a>
                </li>
                <li class="contabilidad" id="contabilidad">
                    <a href="#" onclick="config.Redirect('/contabilidad/index');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/313/313062.svg">
                        <p>Contabilidad</p>
                    </a>
                </li>
                <li class="calendario" id="calendario">
                    <a href="#" onclick="config.Redirect('/calendario');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/123/123392.svg">
                        <p>Calendario</p>
                    </a>
                </li>
                <li class="administrador" id="administrador">
                    <a href="#" onclick="config.Redirect('/administrador/index');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/148/148912.svg">
                        <p>Administrador</p>
                    </a>
                </li>
                <li id="reportes">  
                    <a href="#" onclick="config.Redirect('/reportes/index');">
                        <img style="float: left;" width="30" src="https://image.flaticon.com/icons/svg/1055/1055644.svg">
                        <p>Reportes</p>
                    </a>
                </li>
                <li>
                   <a href="#" onclick="config.Intoredirect('perfil.html?user='+localStorage.getItem('id'));" >
                       <i class="pe-7s-rocket"></i>
                       <p id="perfil"></p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <br><button type="button" id="ocultar" style="margin-left:-20px;margin-top:-100px;background:#2b74c5;color:white;font-size:8px;" onclick="toogle()" >
                        <label><-</label>
                    </button>
                    <br><button type="button" id="mostrar" style="margin-left:-20px;margin-top:-100px;background:#2b74c5;color:white;font-size:8px;" onclick="toogle1()" >
                        <label>-></label>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <input id="searchTerm" type="text" onkeyup="config.doSearch()" style="width:500px;" class="btn btn-warning" placeholder="Busqueda ràpida" />
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <div style="margin-left: 10px;font-size: 12px;margin-top: 8px;">
                                <small>{{ Session::get('nombre') }}</small><br>
                                <small>{{ Session::get('cargo') }}</small> |
                                <small>{{ Session::get('sucursalNombre') }}</small>
                                <a href="/cerrar">
                                    <p id="cerrarSesion">Cerrar Sesión</p>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

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
                            <a href="#">
                                Terminos y Condiciones
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portafolio
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://famc.net.co">famc.net.co</a>, derechos reservados
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