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


$usuarios = App\Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();
$directorios = App\Directorios::where('id_directorio_tipo_tercero', '!=', '1')->
                                where('id_empresa','=',Session::get('id_empresa'))->get();
$carteras = sizeof(App\Carteras::where('tipoCartera', 'like', 'INGRESO')->
                                 where('id_empresa','=',Session::get('id_empresa'))->
                                 orderBy('numero', 'desc')->get());
$auxiliares = App\Pucauxiliar::where('id_empresa','=',14)->get();

?>


    <body>

    <div class="jumbotron text-center" style="background: #4262d3;color:white;">
      <h3>INGRESO</h3>
    </div>
      
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="card"> 
            <div class="row">
              <div class="col-sm-2">
                <label>Prefijo: </label><input type="text" name="prefijo" id="prefijo" class="form-control" value="">
              </div>
              <div class="col-sm-2">
                <label>Número de documento: </label><input type="number" name="numero" id="numero" class="form-control" value="{{ $carteras + 1 }}">
              </div>
              <div class="col-sm-6"><br>
                <?php echo '<a style="color:red;margin-left: 30%;" href="/cartera/ingresos"> + Generar Nuevo Documento</a>'; ?>
              </div>
            </div>

            <div class="row titulo" >
              <div class="col-sm-6">
                <div>
                  <input type="hidden" name="id_cliente" id="id_cliente" class="form-control">
                  <label>Cédula: <a target="_blank" href="/administrador/directorios"><img style="width: 20px;" src="/assets/148764.svg"></a></label>
                  <select name="cedula_tercero" id="cedula_tercero" class="form-control" onchange="carteras.allDocumentos_ingreso();">
                    <option value="">Seleccione Cliente</option>
                    @foreach($directorios as $obj)
                      <option value="{{ $obj['id'] }}">{{ $obj['nit'] }} Nom. {{ $obj['razon_social'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                 <div class="row">
                  <div class="col-sm-6">
                    <label>Fecha:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control">
                  </div>
                  <div class="col-sm-6">
                    <label>Usuario creación:</label>
                    <select name="id_modificado" id="id_modificado" class="form-control">
                      <option value="">Seleccione Usuario</option>
                      @foreach ($usuarios as $obj)
                      <option value="{{ $obj['id'] }}">{{ $obj['ncedula'] }} / {{ $obj['nombre'] }}</option>
                      @endforeach
                    </select>
                  </div>
                  <script>
                    document.getElementById("id_modificado").value = localStorage.getItem("Id_usuario");
                  </script>
                </div>
                <div style="width: 100%;height: 20px;"></div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <p>Facturas con saldo mayor a 0</p>
                <div id="tabla_facturas" style="overflow-y:scroll;height:150px;"></div>
              </div>
              <div class="col-sm-12" style="overflow-x: scroll;">
                <p style="margin-left: 20px;"><br><br>Tabla que indica los documentos que serán incorporados en el egreso:</p> 
                <table id="tabla_facturas_seleccionadas" class="table table-bordered" style="width: 96%;margin-left: 2%;">
                  <thead>
                    <tr>
                      <th><input type="checkbox" name="" id="checkbox_noname"> </th>
                      <th>Prefijo</th>
                      <th># Factura</th>
                      <th>Fecha Factura</th>
                      <th>Flete</th>
                      <th>ReteF.</th>
                      <th>ReteIva.</th>
                      <th>ReteIca.</th>
                      <th>Interes</th>
                      <th>Desc</th>
                      <th>Efectivo</th>
                      <th>Total</th>
                      <th>Puc Auxiliar</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                Nota: <br>
                Si desea <strong>eliminar un producto</strong> primero seleccione la fila y dirijase al boton eliminar.<br>
                <div class="btn btn-danger" onclick="carteras.eliminar();">Eliminar</div><br>
                Si ha <strong>terminado de registrar</strong> las facturas dirijase a escoger la forma de pago.<br><br><br>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="row titulo">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="row" style="overflow-x: scroll;overflow-y: scroll;height: 500px;">
                  <div class="col-sm-12" style="height: 30px;"></div>
                  <p style="margin-left: 20px;">FORMA DE PAGO: </p>
                  <table class="table table-bordered" style="width: 96%;margin-left: 2%;">
                      <thead>
                        <tr>
                          <th>
                            <select id="forma_pago" name="" class="form-control">
                              <option value="EFECTIVO">EFECTIVO</option>
                              <option value="CHEQUE">CHEQUE</option>
                              <option value="CONSIGNACION">CONSIGNACION</option>
                              <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                            </select>
                          </th>
                          <th>
                            <input type="text" id="valor_pago" name="" class="form-control" placeholder="Valor">
                          </th>
                          <th>
                            <input type="text" id="observacion_pago" name="" value="NINGUNA" class="form-control" placeholder="Observacion">
                          </th>
                          <th><div class="btn btn-success form-control" onclick="carteras.getReferenciaPago()">+</div></th>
                        </tr>
                      </thead>
                    </table>
                  <div class="col-sm-12" style="height: 30px;"></div>
                    <p style="margin-left: 20px;"><br><br>Tabla que indica las formas de pago que serán incorporados en el egreso:</p> 
                    <table id="tabla_forma_pago" class="table table-bordered" style="width: 96%;margin-left: 2%;">
                      <thead>
                        <tr>
                          <th>Forma de Pago</th>
                          <th>Valor</th>
                          <th>Observaciones</th>
                        </tr>
                      </thead>
                    </table>
                    <label>Total Forma Pago</label>
                    <input type="text" class="form-control" id="total_forma_pago" value="" disabled="">
                </div>
              </div>
            </div>

            
            <div>
              <div class="col-sm-12">
                <div class="row titulo">
                  <div class="col-sm-3">
                    <label>Fletes</label>
                    <input type="text" id="valor_flete" value="0" class="form-control" disabled="">
                  </div>
                  <div class="col-sm-3">
                    <label>Retefuente</label>
                    <input value="0" type="text" id="valor_retefuente" class="form-control" disabled="">
                  </div>
                  <div class="col-sm-3">
                    <label>Reteiva</label>
                    <input value="0" type="text" id="valor_reteiva" class="form-control" disabled="">
                  </div>
                  <div class="col-sm-3">
                    <label>Reteica</label>
                    <input type="text" value="0" id="valor_reteica" class="form-control" disabled="">
                  </div>
                  <div class="col-sm-3">
                    <label>InteresL</label>
                    <input type="text" value="0" id="valor_interes" class="form-control" disabled="">
                  </div>
                  <div class="col-sm-3">
                    <label>Descuento</label>
                    <input type="text" value="0" id="valor_descuento" class="form-control" disabled="">
                  </div>
                  <div class="col-sm-3">
                    <label>Efectivo</label>
                    <input type="text" value="0" id="valor_efectivo" class="form-control" disabled="">
                  </div>
                  <div class="col-sm-3">
                    <label>TOTAL</label>
                    <input type="number" name="total" id="total" class="form-control" disabled="">
                  </div>
                  <div class="col-sm-12" style="height: 20px;"></div>
                  <div class="col-sm-12">
                    <label>CONDICIONES DE </label>
                    <input id="observaciones" name="observaciones" class="form-control" value="SIN OBSERVACIONES" >
                  </div>
                  <div class="col-sm-12" style="height: 20px;"></div>
                  <div class="col-sm-12">
                    <div id="Guardar" class="btn btn-success form-control" onclick="carteras.save_documento('INGRESO');" style="background-color: #28a745;color:white;">GUARDAR</div>
                    <div id="imprimirPOST" onclick="carteras.imprimirPost();" class="btn btn-warning form-control" style="background-color: white;">Imprimir Pos</div>
                    <div id="imprimirDOC" onclick="carteras.imprimir();" class="btn btn-danger form-control" style="background-color: white;">Imprimir Documento</div>
                  </div>
                  <div class="col-sm-12" style="height: 20px;"></div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
          $('#imprimirPOST').hide();
          $('#imprimirDOC').hide();

          $('#checkbox_noname').change(function(){
            var tabla = document.getElementById("tabla_productos");
            if($(this).is(":checked")){
              for (var i=1;i < tabla.rows.length; i++){  
                id = document.getElementById(tabla.rows[i].cells[0].getElementsByTagName("input")[0].id);
                id.checked = true;
                var padre = id.parentNode.parentNode;
                padre.style.background = "#4262d3";
                padre.style.color = "#ffffff";
              }
            }
            else{
              for (var i=1;i < tabla.rows.length; i++){  
                id = document.getElementById(tabla.rows[i].cells[0].getElementsByTagName("input")[0].id);
                id.checked = false;
                var padre = id.parentNode.parentNode;
                padre.style.background = "#ffffff";
                padre.style.color = "#000000";
              }
            }
          });
    </script>



<div id="resultado"></div>

<script type="text/javascript">
  document.getElementById('prefijo').focus();
</script>

</body>
</html>