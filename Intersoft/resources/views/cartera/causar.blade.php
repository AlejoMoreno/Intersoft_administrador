<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="/assets/img/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <title>Documento</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="/assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="http://localhost:8000/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- TEXT EDTIT -->
    <link rel="stylesheet" href="https://imperavi.com/assets/redactor/redactor.min.css" />
    <script src="https://imperavi.com/assets/redactor/redactor.js?v"></script>

    <style type="text/css">
    .error{
      position: absolute;
    }
    .peligro{
      position: absolute;
      margin-top: -80px;
    }
      .card{
        padding: 10px;
        -webkit-box-shadow: 0px 0px 11px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 11px 0px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 11px 0px rgba(0,0,0,0.75);
      }
      .row .titulo{
        background: #dbdbdb;
        color:black;
        margin-top: 20px;
        -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
      }
      table{
        -webkit-box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 2px 0px rgba(0,0,0,0.75);
      }
      #listDirectorio, #listDirectorio2, .lista {
        display: none;
        position: relative;
        overflow-y: scroll;
        height: 100px;
        width: 100%;
        list-style-type: none;
        padding: 0;
        margin: 0;
      }
      #listDirectorio li a, #listDirectorio2 li a, .lista li a{
        border: 1px solid #ffffff;
        margin-top: -1px; /* Prevent double borders */
        background-color: #4262d3;
        padding: 12px;
        text-decoration: none;
        font-size: 18px;
        color: #ffffff;
        display: block
      }

      #listDirectorio li a:hover:not(.header), #listDirectorio2 li a:hover:not(.header), .lista li a:hover:not(.header)  {
        background-color: #87CB16;
      }
      #listDirectorio li a:focus:not(.header), #listDirectorio2 li a:focus:not(.header), .lista li a:focus:not(.header)  {
        background-color: #87CB16;
      }
      small{
        font-size: 10px;
      }
    </style>

    <!-- CSS FAMC -->
    <link rel="stylesheet" href="/css/menu.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- SCRIPTS FAMC -->
    <script src="/js/config.js"></script>
    <script src="/js/DB/sesion.js"></script>
    <script src="/js/perfil.js"></script>
    <script src="/js/marcas.js"></script>
    <script src="/js/lineas.js"></script>
    <script src="/js/usuarios.js"></script>
    <script src="/js/productos.js"></script>
    <script src="/js/ciudades.js"></script>

    <script src="/js/administrador/directorios.js"></script>
    <script src="/js/administrador/sucursales.js"></script>
    <script src="/js/administrador/usuarios.js"></script>

    <script src="/js/inventario/clasificaciones.js"></script>
    <script src="/js/inventario/tipo_presentacion.js"></script>
    <script src="/js/inventario/lineas.js"></script>
    <script src="/js/inventario/marcas.js"></script>
    <script src="/js/inventario/referencias.js"></script>
    <script src="/js/cartera/index.js"></script>

   

<style type="text/css">
  ul::-webkit-scrollbar-thumb
{
  border-radius: 10px;
  background-color: #FFF;
  background-image: -webkit-linear-gradient(top,
                        #e4f5fc 0%,
                        #bfe8f9 50%,
                        #9fd8ef 51%,
                        #2ab0ed 100%);
}
</style>
    
</head>


<?php


$usuarios = App\Usuarios::all();
$proveedores = App\Directorios::where('id_directorio_tipo_tercero', '=', '1')->get();
$clientes = App\Directorios::where('id_directorio_tipo_tercero', '=', '2')->get();
$terceros = App\Directorios::where('id_directorio_tipo_tercero', '=', '3')->get();

?>


    <body>

    <div class="jumbotron text-center" style="background: #4262d3;color:white;">
      <h3>Causar</h3>
    </div>
      
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
        	
        </div>
      </div>
    </div>



<div id="resultado"></div>

<script type="text/javascript">
  document.getElementById('prefijo').focus();
</script>

</body>
</html>