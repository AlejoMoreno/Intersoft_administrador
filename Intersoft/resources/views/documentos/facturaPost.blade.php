<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="/assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <title>Documento</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         
          <!--     Fonts and icons     -->
          <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
          <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
          <link href="http://localhost:8000/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

          <!-- TEXT EDTIT -->
          <link rel="stylesheet" href="https://imperavi.com/assets/redactor/redactor.min.css" />
          <script src="https://imperavi.com/assets/redactor/redactor.js?v"></script>
      
          
      
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<style>
*{
    margin:0;
    padding:0;
}
</style>

<?php /**
-----------------------------------------------------------------------------------------
SIGNO MENOS
-----------------------------------------------------------------------------------------
*/ ?>


<?php

  
use Illuminate\Support\Facades\DB;

$tipo_pagos = App\Tipopagos::where('id_empresa','=',Session::get('id_empresa'))->get();

    //variables importantes para la vista

    $nombre_directorio = "Clientes";
 
    $usuarios = App\Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();

    //traer las referencias dependiendo el tipo de entrada
    // $referencias =  DB::SELECT("SELECT * FROM `referencias` WHERE id IN (SELECT id_referencia FROM `lotes` where sucursal = ".Session::get('sucursal').") AND saldo > 0");
    $referencias = App\Referencias::where('saldo','>','0')->
                                    where('id_empresa','=',Session::get('id_empresa'))->get();


    foreach ($referencias as $referencia) {
      $referencia->lotes = App\Lotes::where('id_referencia',$referencia->id)->
                                      where('id_empresa','=',Session::get('id_empresa'))->get();
    }
    

    //buscar el mayor numero del documento que existe
    $factura = App\Facturas::where('numero',$_GET['numero'])->
                            where('prefijo',$_GET['prefijo'])->
                            where('id_documento',$_GET['id'])->
                            where('id_empresa','=',Session::get('id_empresa'))->
                            orderBy('numero', 'desc')->get();
    if(sizeof($factura) == 0){
      $factura->numero = $_GET['numero'];
    }
    else{
      $factura = $factura[0];
    }

    ?>

<body >
    <div class="content">
        <div class="row">
            <div class="col-md-7">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="Factura1-tab" data-toggle="tab" href="#Factura1" role="tab" aria-controls="Factura1" aria-selected="true">Factura 1</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="Factura1" role="tabpanel" aria-labelledby="Factura1-tab">
                        <div class="card">
                            <div class="card-body" style="overflow-x: scroll;height: 318px;">
                                <table id="tabla_productos" class="table table-bordered" style="width: 96%;margin-left: 2%;">
                                    <thead>
                                        <tr>
                                        <th><input type="checkbox" name="" id="checkbox_noname"> </th>
                                        <th>REFERNCIA</th>
                                        <th>DESCRIPCIÓN</th>
                                        <th>LOTE</th>
                                        <th></th>
                                        <th></th>
                                        <th>CANTIDAD</th>
                                        <th>DSC_(%)</th>
                                        <th>VALOR_UNIDAD.</th>
                                        <th>IVA</th>
                                        <th>VALOR_TOTAL.</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="card-footer">
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
                                    </div>
                                </div>
                                <div class="col-md-12"><br></div>
                                <div class="row" >
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            (+) Nota
                                        </button>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-success" onclick="documentos.save_documento();">Imprimir</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#clienteModal">
                                            (+) Cliente
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5" >
                <div class="card">
                    <ul class="nav nav-tabs" id="myTabProduc" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="Productos1-tab" data-toggle="tab" href="#Productos1" role="tab" aria-controls="Productos1" aria-selected="true">Productos1</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="Productos1" role="tabpanel" aria-labelledby="Productos1-tab">
                            <div class="card">
                                <div class="card-body" ><div class="row">
                                    <div class="col-sm-12">
                                        <div class="row" style="overflow-x: scroll;overflow-y: scroll;height: 500px;">
                                            <div >
                                                <table class="table" id="lista_referencias" >
                                                <tr>
                                                    <th>Añadir</th>
                                                    <th><input type="text" id="search_referencia" onkeyup="documentos.searchReferencia(1,'search_referencia');" name="" class="form-control" style="width: 100px;" placeholder="REFERNCIA"></th>
                                                    <th><input type="text" id="search_codigobarras" onkeyup="documentos.searchReferencia(2,'search_codigobarras');" name="" class="form-control" style="width: 100px;" placeholder="CODIGO BARRAS"></th>
                                                    <th><input type="text" id="search_descrpcion" onkeyup="documentos.searchReferencia(3,'search_descrpcion');" name="" class="form-control" style="width: 100px;" placeholder="DESCRIPCION"></th>
                                                    <th>iva.</th>
                                                    <th>Costo.</th>
                                                    <th>Saldo.</th>
                                                    <th>Añadir</th>
                                                </tr>
                                                @foreach ($referencias as $obj)
                                                <tr onclick="documentos.seleccionReferencia({{ $obj }})" >
                                                    <td></td>
                                                    <td>{{ $obj['codigo_interno'] }}</td>
                                                    <td>{{ $obj['codigo_barras'] }}</td>
                                                    <td>{{ $obj['descripcion'] }}</td>
                                                    <td>{{ $obj['iva'] }}</td>
                                                    <td>{{ number_format($obj['costo_promedio'], 2, ',', '.') }}</td>
                                                    <td>{{ number_format($obj['saldo'], 2, ',', '.') }}</td>
                                                    <td><div onclick="documentos.seleccionReferencia({{ $obj }})" class="btn btn-success" >+</div></td>
                                                </tr>
                                                @endforeach
                                                </table>
                                            </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    
                                            

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">CONDICIONES DE <?php echo $_GET['nombre']; ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input id="observaciones" name="observaciones" class="form-control" onkeyup="documentos.enterObser(event);" value="SIN OBSERVACIONES" >
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="clienteModal" tabindex="-1" role="dialog" aria-labelledby="clienteModallLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clienteModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="jumbotron text-center" style="background: #4262d3;color:white;">
                    <h3><?php echo $_GET['nombre']; ?></h3>
                    <input type="hidden" name="idDocumento" id="idDocumento" value="<?php echo $_GET['id'] ?>">
                    <input type="hidden" name="signoDocumento" id="signoDocumento" value="-">
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <label>Prefijo: </label><input type="text" name="prefijo" id="prefijo" class="form-control" value="<?php echo $_GET['prefijo']; ?>" onkeyup="documentos.siguiente(event,'numero');" disabled>
                    </div>
                    <div class="col-sm-6">
                        <label>Número de documento: </label><input type="number" name="numero" id="numero" class="form-control" value="<?php echo intval($factura->numero + 1); ?>" onkeyup="documentos.siguiente(event,'cedula_tercero');" disabled>
                    </div>
                    </div>
                    
                    <div class="row titulo" >
                    <div class="col-sm-6">
                        <div>
                        <input type="hidden" name="id_cliente" id="id_cliente" class="form-control">
                        <label>Cédula: </label>
                        <input type="text" list="listDirectorio" name="cedula_tercero"  id="cedula_tercero" class="form-control" onchange="buscarcliente(this.value)">
                        <datalist id="listDirectorio">
                            
                        </datalist>
                        <p style="font-size:10px">Para buscar el cliente debe tener un minimo de 6 caracteres</p>
                        <script>
                        function buscarcliente(texto){
                            console.log(texto);
                            if(texto.length > 5){
                                var urls = "/administrador/diretorios/search/searchText";
                                parametros = {
                                        "texto" : texto
                                    };
                                    $.ajax({
                                        data:  parametros,
                                        url:   urls,
                                        type:  'get',
                                        beforeSend: function () {
                                            $('#resultado').html('<p>Espere porfavor</p>');
                                        },
                                        success:  function (response) {
                                            console.log(response);
                                            $('#listDirectorio').html();
                                            for (var i=0; i < response.body.length; i++){
                                                var valor = response.body[i];
                                                optionText = valor.nit + '-' + valor.razon_social;
                                                optionValue = valor.nit;
                                                //console.log(optionText + '  ' + optionValue);
                                                $('#listDirectorio').append('<option value="'+optionValue+'">'+optionText+'</option>');
                                            }
                                        }
                                    });
                            }
                        }
                        </script>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div>
                        <label>Fecha:</label>
                        <?php echo "<input type='text' disbled='true' name='fecha' id='fecha' class='form-control' onkeyup='documentos.fechaActual(event)' value='".date('d/m/yy')."'";?>
                        <label>Fecha Vencimiento:</label>
                        <?php echo "<input type='text' disbled='true' name='fecha_vencimiento' id='fecha_vencimiento' class='form-control' onkeyup='documentos.siguiente(event,`id_modificado`);' value='".date('d/m/yy')."'";?>
                        <label>Vendedor:</label>
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
                    <div class="col-sm-6"> 
                        <label>Tipo Pago: </label>
                        <select id="tipo_pago" name="tipo_pago" class="form-control">                      
                        @foreach ($tipo_pagos as $obj)
                        <option value="{{ $obj['id']}}">{{ $obj['nombre']}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
            </div>
        </div>
        </div>

</body>

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


<style>
    *{
        font-size: 10px;
    }
    .table td, .table th{
        padding: .3rem;
    }
    .alert-warning{
        display: none;
    }
</style>

</html>
