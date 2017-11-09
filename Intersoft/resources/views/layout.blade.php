<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="http://localhost:8000/assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Light Bootstrap Dashboard by Creative Tim</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="http://localhost:8000/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="http://localhost:8000/assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="http://localhost:8000/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="http://localhost:8000/assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="http://localhost:8000/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- CSS FAMC -->
    <link rel="stylesheet" href="http://localhost:8000/css/menu.css">
    <!-- SCRIPTS FAMC -->
    <script src="http://localhost:8000/js/config.js"></script>
    <script src="http://localhost:8000/js/DB/sesion.js"></script>
    <script src="http://localhost:8000/js/perfil.js"></script>
    <script src="http://localhost:8000/js/marcas.js"></script>
    <script src="http://localhost:8000/js/lineas.js"></script>
    <script src="http://localhost:8000/js/usuarios.js"></script>
    <script src="http://localhost:8000/js/productos.js"></script>
    <script src="http://localhost:8000/js/ciudades.js"></script>

    <script src="http://localhost:8000/js/administrador/sucursales.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="http://localhost:8000/assets/img/sidebar-1.jpg">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="dashboard.html" class="simple-text">
                     Intersoft
                </a>
            </div>

            <ul class="nav">
                <li class="active" id="inicio">
                    <a href="#" onclick="config.Redirect('/inicio/index');">
                        <i class="pe-7s-graph"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <li id="entrada_inventario">
                    <a href="#" onclick="config.Redirect('/inventario/index');">
                        <i class="pe-7s-box1"></i>
                        <p>Entrada Inventario</p>
                    </a>
                </li>
                <li id="salida_inventario">
                    <a href="#" onclick="config.Redirect('/salida/index');">
                        <i class="pe-7s-cart"></i>
                        <p>Salida Inventario</p>
                    </a>
                </li>
                <li id="cartera"> 
                    <a href="#" onclick="config.Redirect('/cartera/index');">
                        <i class="pe-7s-cash"></i>
                        <p>Cartera</p>
                    </a>
                </li>
                <li id="contabilidad">
                    <a href="#" onclick="config.Redirect('/contabilidad/index');">
                        <i class="pe-7s-news-paper"></i>
                        <p>Contabilidad</p>
                    </a>
                </li>
                <li id="calendario">
                    <a href="#" onclick="config.Redirect('/calendario');">
                        <i class="pe-7s-date"></i>
                        <p>Calendario</p>
                    </a>
                </li>
                <li id="administrador">
                    <a href="#" onclick="config.Redirect('/administrador/index');">
                        <i class="pe-7s-users"></i>
                        <p>Administrador</p>
                    </a>
                </li>
                <li id="base_de_datos">
                    <a href="#" onclick="config.Redirect('/basesdedatos/index');">
                        <i class="pe-7s-server"></i>
                        <p>Bases de datos</p>
                    </a>
                </li>
                <li id="reportes">  
                    <a href="#" onclick="config.Redirect('/reportes/index');">
                        <i class="pe-7s-graph"></i>
                        <p>Reportes</p>
                    </a>
                </li>
				<li class="active-pro">
                    <a href="#" onclick="config.Redirect('/update/index');">
                        <i class="pe-7s-rocket"></i>
                        <p>Actualizar Intersoft</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
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
                           <a href="#" onclick="config.Intoredirect('perfil.html?user='+localStorage.getItem('id'));" >
                               <p id="perfil"></p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <p id="cerrarSesion">Cerrar Sesión</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- CONTENT ENTER-->
        <div class="content">
            @yield('content')
        </div>
        <!-- CONTENT FIN-->

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
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">famc.net.co</a>, derechos reservados
                </p>
            </div>
        </footer>
        <!-- FORTER FIN-->

    </div>
</div>


</body>

</html>