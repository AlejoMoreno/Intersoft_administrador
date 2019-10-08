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
    <script src="/js/inventario/documentos.js"></script>

   

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

<?php 

$directorios = App\Directorios::where('id_directorio_tipo_tercero', '=', '1')->get();
$usuarios = App\Usuarios::all();
$referencias = App\Referencias::all();


?>
    
</head>
<body>

    <div class="jumbotron text-center" style="background: #4262d3;color:white;">
      <input type="hidden" name="idDocumento" id="idDocumento" value="">
      <input type="hidden" name="signoDocumento" id="signoDocumento" value="+">
    </div>
      
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="card"> 
            <div class="row">
              <div class="col-sm-2">
                <label>Prefijo: </label><input type="text" name="prefijo" id="prefijo" class="form-control" value="" onkeyup="documentos.siguiente(event,'numero');">
              </div>
              <div class="col-sm-2">
                <label>Número de documento: </label><input type="number" name="numero" id="numero" class="form-control" value="" onkeyup="documentos.siguiente(event,'cedula_tercero');">
              </div>
            </div>

            <div class="row titulo" >
              <div class="col-sm-6">
                <h3>:</h3>
                <div>
                  <input type="hidden" name="id_cliente" id="id_cliente" class="form-control">
                  <label>Cédula / Nombre: <a target="_blank" href="/administrador/directorios"><img title="crear nuevo " style="width: 20px;" src="https://image.flaticon.com/icons/svg/148/148764.svg"></a></label>
                  <input type="text" list="listDirectorio" name="cedula_tercero"  id="cedula_tercero" class="form-control">
                  <datalist id="listDirectorio">
                  	@foreach ($directorios as $obj)
                    <option value="{{ $obj['nit'] }}" >{{ $obj['nit'] }} _ {{ $obj['razon_social'] }}</option>
                    @endforeach
                  </datalist>
                  
                  
                </div>
              </div>
              <div class="col-sm-6">
                <h3>Fecha Documento:</h3>
                 <div>
                  <label>Fecha:</label>
                  <input type="date" name="fecha" id="fecha" class="form-control" onkeyup="documentos.fechaActual(event)">
                  <label>Fecha vencimiento:</label>
                  <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" onkeyup="documentos.siguiente(event,'id_modificado');">
                  <label>Usuario creación:</label>
                  <input type="text" name="id_modificado" id="id_modificado" list="usuarios" class="form-control" placeholder="Esciba el nombre del vendedor" onkeyup="documentos.siguiente(event,'search_referencia');">
                  <datalist id="usuarios">
                    @foreach ($usuarios as $obj)
                    <option value="{{ $obj['id'] }}">{{ $obj['ncedula'] }} / {{ $obj['nombre'] }}</option>
                    @endforeach
                  </datalist>
                  <script>
                    document.getElementById("id_modificado").value = localStorage.getItem("Id_usuario");
                  </script>
                </div>
                <div style="width: 100%;height: 20px;"></div>
              </div>
              <div class="col-sm-2"> <select id="tipo_pago" name="tipo_pago" class="form-control"><option value="efectivo">EFECTIVO</option><option value="credito">CREDITO</option><option value="na">NA</option></select></div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="row" style="overflow-x: scroll;overflow-y: scroll;height: 500px;">
                  <div style="position: fixed;width: 100%;left: 0px;bottom: -10px; height: 150px;background: white;z-index: 200;overflow: scroll;">
                      <table class="table" id="lista_referencias" >
                        <tr>
                          <th>Añadir</th>
                          <th><input type="text" id="search_referencia" onkeyup="documentos.searchReferencia(1,'search_referencia');" name="" class="form-control" style="width: 100px;" placeholder="REFERNCIA"></th>
                          <th><input type="text" id="search_codigobarras" onkeyup="documentos.searchReferencia(2,'search_codigobarras');" name="" class="form-control" style="width: 100px;" placeholder="CODIGO BARRAS"></th>
                          <th><input type="text" id="search_descrpcion" onkeyup="documentos.searchReferencia(3,'search_descrpcion');" name="" class="form-control" style="width: 100px;" placeholder="DESCRIPCION"></th>
                          <th>Stock_min.</th>
                          <th>Stock_max.</th>
                          <th>iva.</th>
                          <th>Costo.</th>
                          <th>Saldo.</th>
                          <th>Añadir</th>
                        </tr>
                        @foreach ($referencias as $obj)
                        <tr>
                          <td><div onclick="documentos.seleccionReferencia({{ $obj }})" class="btn btn-success" >+</div></td>
                          <td>{{ $obj['codigo_interno'] }}</td>
                          <td>{{ $obj['codigo_barras'] }}</td>
                          <td>{{ $obj['descripcion'] }}</td>
                          <td>{{ $obj['stok_minimo'] }}</td>
                          <td>{{ $obj['stok_maximo'] }}</td>
                          <td>{{ $obj['iva'] }}</td>
                          <td>{{ $obj['costo_promedio'] }}</td>
                          <td>{{ $obj['saldo'] }}</td>
                          <td><div onclick="documentos.seleccionReferencia({{ $obj }})" class="btn btn-success" >+</div></td>
                        </tr>
                        @endforeach
                      </table>
                    </div>
                  <div class="col-sm-12" style="height: 30px;"></div>
                    <p style="margin-left: 20px;"><br><br>Tabla que indica los productos que serán incorporados en el documento:</p> 
                    
                    <table id="" style="width: 96%;margin-left: 2%;">
                      <thead>
                        <tr>
                          <th><input type="checkbox" name="" id="checkbox_noname"> </th>
                          <th>REFERNCIA</th>
                          <th>DESCRIPCIÓN</th>
                          <th>LOTE</th>
                          <th>SERIAL</th>
                          <th>FECHA_VENCE</th>
                          <th>CANTIDAD</th>
                          <th>DSC (%)</th>
                          <th>VALOR_UNIDAD.</th>
                          <th>IVA</th>
                          <th>VALOR_TOTAL.</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@foreach( $kardex as $obj )
                      	<tr>
                      		<td></td>
                      		<td>{{ $obj['id'] }}</td>
	                        <td>{{ $obj['id'] }}</td>
	                        <td>{{ $obj['lote'] }}</td>
	                        <td>{{ $obj['serial'] }}</td>
	                        <td>{{ $obj['fecha_vencimiento'] }}</td>
	                        <td>{{ $obj['cantidad'] }}</td>
	                        <td>{{ $obj['descuento'] }}</td>
	                        <td>{{ $obj['precio'] }}</td>
	                        <td>{{ $obj['iva'] }}</td>
	                        <td>{{ $obj['total'] }}</td>
                      	</tr>
                      	@endforeach
                      </tbody>
                    </table>
                    <br><br>
                    <table id="tabla_productos" class="table table-bordered" style="width: 96%;margin-left: 2%;">
                      <thead>
                        <tr>
                          <th><input type="checkbox" name="" id="checkbox_noname"> </th>
                          <th>REFERNCIA</th>
                          <th>DESCRIPCIÓN</th>
                          <th>LOTE</th>
                          <th>SERIAL</th>
                          <th>FECHA_VENCE</th>
                          <th>CANTIDAD</th>
                          <th>DSC (%)</th>
                          <th>VALOR_UNIDAD.</th>
                          <th>IVA</th>
                          <th>VALOR_TOTAL.</th>
                        </tr>
                      </thead>
                    </table>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                Nota: <br>
                Para <strong>agregar productos</strong> dirijase al boton más.<br>
                Si desea <strong>eliminar un producto</strong> primero seleccione la fila y dirijase al boton eliminar.<br>
                <div class="btn btn-danger" onclick="documentos.eliminar();">Eliminar</div><br>
                Si ha <strong>terminado de registrar</strong> los productos dirijase al boton Guardar.<br><br><br>
              </div>
              <div class="col-sm-12">
                <div class="row titulo">
                  <div class="col-sm-3">
                    <label>SUB.TOTAL</label>
                    <input type="number" name="subtotal" id="subtotal" class="form-control" disabled="">
                  </div>
                  <div class="col-sm-3">
                    <label>IVA</label>
                    <input type="number" name="iva" id="iva" class="form-control" disabled="">
                  </div>
                  <div class="col-sm-3">
                    <label>DESCUENTO</label>
                    <input type="number" name="descuento" id="descuento" class="form-control" disabled="">
                  </div>
                  <div class="col-sm-3">
                    <label>FLETES</label>
                    <input type="number" name="fletes" value="0" id="fletes" onkeyup="documentos.recorrer();" class="form-control">
                  </div>
                  <div class="col-sm-3">
                    <label>RETEFUENTE</label>
                    <input type="number" name="retefuente" value="0" id="retefuente" class="form-control" onkeyup="documentos.recorrer();">
                  </div>
                  <div class="col-sm-3">
                    <label>IMPOCONSUMO</label>
                    <input type="number" name="impoconsumo" value="0" id="impoconsumo" class="form-control" onkeyup="documentos.recorrer();">
                  </div>
                  <div class="col-sm-3">
                    <label>Otro Impuesto</label>
                    <input type="number" name="otro_impuesto" value="0" id="otro_impuesto" class="form-control" onkeyup="documentos.recorrer();">
                  </div>
                  <div class="col-sm-3">
                    <label>TOTAL</label>
                    <input type="number" name="total" id="total" class="form-control" disabled="">
                  </div>
                  <div class="col-sm-12" style="height: 20px;"></div>
                  <div class="col-sm-12">
                    <label>CONDICIONES DE </label>
                    <input id="observaciones" name="observaciones" class="form-control" onkeyup="documentos.enterObser(event);" value="SIN OBSERVACIONES" >
                  </div>
                  <div class="col-sm-12" style="height: 20px;"></div>
                  <div class="col-sm-12">
                    <div id="Guardar" class="btn btn-success form-control" onclick="documentos.save_documento();" style="background-color: #28a745;color:white;">GUARDAR</div>
                    <div id="imprimirPOST" onclick="documentos.imprimirPost();" class="btn btn-warning form-control" style="background-color: white;">Imprimir Pos</div>
                    <div id="imprimirDOC" onclick="documentos.imprimir();" class="btn btn-danger form-control" style="background-color: white;">Imprimir Documento</div>
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

</body>
</html>