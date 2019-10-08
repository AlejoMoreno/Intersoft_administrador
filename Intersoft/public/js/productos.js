var producto = new Productos();
function Productos(){

    var linea;
    var marca;
    var descripcion;
    var referencia;
    var codigobarras;
    var stockminimo;
    var stockmaximo;
    var precio1;
    var precio2;
    var precio3;
    var precio4;
    var costopromedio;
    var ultimocosto;
    var impoconsumo;
    var iva;
    var descuento;
    var factorrendimiento;
    var clasificacion;
    var pesokilo;
    var homologo;
    var saldo;
    var sucursal;
    var presentacion;

    this.addProductos = function(){
        $('#formularioProductos').show(500);
        $('#tablaProductos').hide();
        $('#linea').focus();
    };

    this.guardarProducto = function(){
        var myJsonString = JSON.stringify(productos);
        console.log(myJsonString);
        productos['function']='guardarProducto';
        $.ajax({
                data:  myJsonString,
                url:   '../api/activar.php',
                type:  'post',
                beforeSend: function () {
                    //alert('espere');
                },
                success:  function (response) {
                    alert(response);
                }
        });
    };

    this.guardarProducto = function(){
        alert(localStorage.getItem('Id_empresa'));
        var parametros = {
            "Autorization"  : "92383af3b97f5e992ab9050693941816",
            "function"      : "guardarProducto",
            "Id_linea"      : $('#linea').val(),
            "Id_marca"      : $('#marca').val(),
            "Descripcion"   : $('#descripcion').val(),
            "Referencia"    : $('#referencia').val(),
            "Codigo_barras" : $('#codigobarras').val(),
            "Stock_minimo"  : $('#stockminimo').val(),
            "Stock_maximo"  : $('#stockmaximo').val(),
            "Precio1"       : $('#precio1').val(),
            "Precio2"       : $('#precio2').val(),
            "Precio3"       : $('#precio3').val(),
            "Precio4"       : $('#precio4').val(),
            "Costopromedio" : $('#costopromedio').val(),
            "Costo"   : $('#ultimocosto').val(),
            "Impuesto_consumo"   : $('#impoconsumo').val(),
            "Iva"           : $('#iva').val(),
            "Descuento"     : $('#descuento').val(),
            "Factor_rendimiento": $('#factorrendimiento').val(),
            "Id_clasificacion" : $('#clasificacion').val(),
            "Peso_kilo"     : $('#pesokilo').val(),
            "Homologo"      : $('#homologo').val(),
            "Saldo"         : $('#saldo').val(),
            "Id_sucursal"    : $('#sucursal').val(),
            "Presentacion"  : $('#presentacion').val(),
            "Id_empresa"    : localStorage.getItem("Id_empresa"),
            "Id_usuario"    : localStorage.getItem("Id_usuario"),
            "Estado"        : $('#estado').val(),
            "imagen"        : "url"
        };
        $.ajax({
            data:  parametros,
            url:   '../api/inventario.php',
            type:  'post',
            beforeSend: function () {
                $('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
            },
            success:  function (response) {
                console.log(response);
                var obj = JSON.parse(response);
                if(obj.status=='true'){
                    $('#resultado').css("color","green").html(obj.message);
                    config.Intoredirect('inventario/productos.html');
                }
                else{
                    $('#resultado').html('No se encontraron Coincidencias');
                }
            }
        });
    };

    this.searchProductos = function(){
        $('#formularioProductos').hide();
        $('#tablaProductos').show(500);
    };

    this.SelectSucursales = function(name,div){
		var parametros = {
            "Autorization" : "92383af3b97f5e992ab9050693941816",
            "function" : "getSucursales"
        };
        $.ajax({
            data:  parametros,
            url:   '../api/parametros.php',
            type:  'post',
            beforeSend: function () {
                $('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
            },
            success:  function (response) {
                var obj = JSON.parse(response);
                //console.log(response);
                if(obj.status=='true'){
                    var select = '';
                    select += '<select class="form-control" id="'+name+'" name="'+name+'">';
                    select += '<option value="">Seleccione Sucursales</option>';
                    for (var i = 0; i < obj.message.length; i++){
                        select += '<option value="'+obj.message[i].Id_sucursal+'">'+obj.message[i].Nombre+'</option>';
                    }                        
                    select += '</select>';
                    $('#'+div).html(select);                        
                }
                else{
                    $('#'+div).html('Hay problemas con el internet');
                }
            }
        });		
    };

    this.SelectMarcas = function(name,div){
		var parametros = {
            "Autorization" : "92383af3b97f5e992ab9050693941816",
            "function" : "getMarcas"
        };
        $.ajax({
            data:  parametros,
            url:   '../api/inventario.php',
            type:  'post',
            beforeSend: function () {
                $('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
            },
            success:  function (response) {
                var obj = JSON.parse(response);
                if(obj.status=='true'){
                    var select = '';
                    select += '<select class="form-control" id="'+name+'" name="'+name+'">';
                    select += '<option value="">Seleccione Marca</option>';
                    for (var i = 0; i < obj.message.length; i++){
                        select += '<option value="'+obj.message[i].Id_marca+'">'+obj.message[i].Nombre+'</option>';
                    }                        
                    select += '</select>';
                    $('#'+div).html(select);                        
                }
                else{
                    $('#'+div).html('Hay problemas con el internet');
                }
            }
        });		
    };
    
    this.SelecLineas = function(name,div){
		var parametros = {
            "Autorization" : "92383af3b97f5e992ab9050693941816",
            "function" : "getLineas"
        };
        $.ajax({
            data:  parametros,
            url:   '../api/inventario.php',
            type:  'post',
            beforeSend: function () {
                $('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
            },
            success:  function (response) {
                var obj = JSON.parse(response);
                if(obj.status=='true'){
                    var select = '';
                    select += '<select class="form-control" id="'+name+'" name="'+name+'">';
                    select += '<option value="">Seleccione Línea</option>';
                    for (var i = 0; i < obj.message.length; i++){
                        select += '<option value="'+obj.message[i].Id_linea+'">'+obj.message[i].Nombre+'</option>';
                    }                        
                    select += '</select>';
                    $('#'+div).html(select);                        
                }
                else{
                    $('#'+div).html('Hay problemas con el internet');
                }
            }
        });		
    };
    
    this.searchProductos = function(){
		var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "getProductos"
        };
        
       /* config.httpPost(parametros, '../api/inventario.php', 'resultado');
        console.log(config.obj);*/
        $.ajax({
			data:  parametros,
			url:   '../api/inventario.php',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
			},
			success:  function (response) {
				obj = JSON.parse(response);
				if(obj.status=='true'){
					$('#resultado').html('');
                    console.log(obj.message);
                    producto.PrintTable(obj.message);
				}
				else{
					$('#resultado').html('Hay problemas con el internet');
				}
			}
        });	
	};
    
	this.PrintTable = function(Json){
		$('#formularioProductos').hide();
	    $('#tablaProductos').show(500);
	    if(Json != undefined){
	    	//console.log(Json);
		    //recorrer para escibir la tabla con los datos de las marcas
		    $("#tableproductos tr").remove();//vaciar la tabla
            $("#tableproductos").append("<thead> <th>ID</th> "+
                "<th>Icon</th> "+
                "<th>Referencia</th>"+
                "<th>Descripcion</th>"+
                "<th>Codigo_barras</th>"+
                "<th>Iva</th>"+
                "<th>Precio1</th>"+
                "<th>Costo</th>"+
                "<th>Costopromedio</th>"+ 
                "<th></th> <th></th> </thead>");
		    var table = document.getElementById("tableproductos"); //se toma como objeto la tabla de marcas
		    for (var i = 0; i < Json.length; i++) { //se recorre el json
                var row = table.insertRow(); // insertar fila
                
		    	var id          = row.insertCell(0); //insertar celdas
			    var Icon        = row.insertCell(1); //insertar celdas
                var Referencia  = row.insertCell(2); //insertar celdas
                var Descripcion = row.insertCell(3); //insertar celdas
                var Codigo_barras = row.insertCell(4); //insertar celdas
                var Iva         = row.insertCell(5); //insertar celdas
                var Precio1     = row.insertCell(6); //insertar celdas
                var Costo       = row.insertCell(7); //insertar celdas
                var Costopromedio = row.insertCell(8); //insertar celdas
			    var update      = row.insertCell(9); //insertar celdas
                var drop        = row.insertCell(10); //insertar celdas
                
			    id.innerHTML            = i+1; //poner el nombre de la celda
			    Icon.innerHTML          = Json[i].Icon; //poner el nombre de la celda
                Referencia.innerHTML    = Json[i].Referencia; //poner el nombre de la celda
                Descripcion.innerHTML   = Json[i].Descripcion; //poner el nombre de la celda
                Codigo_barras.innerHTML = Json[i].Codigo_barras; //poner el nombre de la celda
                Iva.innerHTML           = Json[i].Iva; //poner el nombre de la celda
                Precio1.innerHTML       = Json[i].Precio1; //poner el nombre de la celda
                Costo.innerHTML         = Json[i].Costo; //poner el nombre de la celda
                Costopromedio.innerHTML = Json[i].Costopromedio; //poner el nombre de la celda
			    update.innerHTML        = '<button onclick="producto.GetParticular('+Json[i].Id_producto+');" class="btn btn-warning">></button>'; //poner el nombre de la celda
			    drop.innerHTML          = '<button onclick="producto.drop('+Json[i].Id_producto+','+(i+1)+');" class="btn btn-danger">x</button>'; //poner el nombre de la celda
		    }
	    }
    };

    this.GetParticular = function(id){
		var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "GetParticularProducto",
        "id": id
        };
        $.ajax({
			data:  parametros,
			url:   '../api/inventario.php',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
			},
			success:  function (response) {
				var obj = JSON.parse(response);
				if(obj.status=='true'){
					$('#resultado').html('');
					//console.log(obj.message);
					if(obj.message != undefined){
				    	console.log(JsonMarcasUpdate);
				    	$('#form-update').show();
				     	$('#upproducto').val(obj.message[0].Id_producto);
						$('#uplinea').val(obj.message[0].Id_linea);
                        $('#upmarca').val(obj.message[0].Id_marca);
                        $('#updescripcion').val(obj.message[0].Descripcion);
                        $('#upreferencia').val(obj.message[0].Referencia);
                        $('#upcodigobarras').val(obj.message[0].Codigo_barras);
                        $('#upstockminimo').val(obj.message[0].Stock_minimo);
                        $('#upstockmaximo').val(obj.message[0].Stock_maximo);
                        $('#upprecio1').val(obj.message[0].Precio1);
                        $('#upprecio2').val(obj.message[0].Precio2);
                        $('#upprecio3').val(obj.message[0].Precio3);
                        $('#upprecio4').val(obj.message[0].Precio4);
                        $('#upcostopromedio').val(obj.message[0].Costopromedio);
                        $('#upultimocosto').val(obj.message[0].Costo);
                        $('#upimpoconsumo').val(obj.message[0].Impuesto_consumo);
                        $('#upiva').val(obj.message[0].Iva);
                        $('#updescuento').val(obj.message[0].Descuento);
                        $('#upfactorrendimiento').val(obj.message[0].Factor_rendimiento);
                        $('#uppesokilo').val(obj.message[0].Peso_kilo);
                        $('#uphomologo').val(obj.message[0].Homologo);
                        $('#upsaldo').val(obj.message[0].Saldo);
                        $('#upsucursal').val(obj.message[0].Id_sucursal);
                        $('#uppresentacion').val(obj.message[0].Presentacion);
                        $('#upestado').val(obj.message[0].Estado);
                        $('#upclasificacion[value=' + obj.message[0].Id_clasificacion + ']').attr('selected',true);
				    }
				}
				else{
					$('#resultado').html('Hay problemas con el internet');
				}
			}
        });		
    };
    
    this.updateProducto = function(){
		var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "updateProductos",
        "Id_linea"      : $('#uplinea').val(),
        "Id_marca"      : $('#upmarca').val(),
        "Descripcion"   : $('#updescripcion').val(),
        "Referencia"    : $('#upreferencia').val(),
        "Codigo_barras" : $('#upcodigobarras').val(),
        "Stock_minimo"  : $('#upstockminimo').val(),
        "Stock_maximo"  : $('#upstockmaximo').val(),
        "Precio1"       : $('#upprecio1').val(),
        "Precio2"       : $('#upprecio2').val(),
        "Precio3"       : $('#upprecio3').val(),
        "Precio4"       : $('#upprecio4').val(),
        "Costopromedio" : $('#upcostopromedio').val(),
        "Costo"   : $('#upultimocosto').val(),
        "Impuesto_consumo"   : $('#upimpoconsumo').val(),
        "Iva"           : $('#upiva').val(),
        "Descuento"     : $('#updescuento').val(),
        "Factor_rendimiento": $('#upfactorrendimiento').val(),
        "Id_clasificacion" : $('#upclasificacion').val(),
        "Peso_kilo"     : $('#uppesokilo').val(),
        "Homologo"      : $('#uphomologo').val(),
        "Saldo"         : $('#upsaldo').val(),
        "Id_sucursal"    : $('#upsucursal').val(),
        "Presentacion"  : $('#uppresentacion').val(),
        "Id_empresa"    : localStorage.getItem("Id_empresa"),
        "Id_usuario"    : localStorage.getItem("Id_usuario"),
        "Estado"        : $('#upestado').val(),
        "imagen"        : "url",
        "id"            : $('#upproducto').val()
        };
        $.ajax({
			data:  parametros,
			url:   '../api/inventario.php',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
			},
			success:  function (response) {
				var obj = JSON.parse(response);
				if(obj.status=='true'){
					config.Intoredirect('inventario/productos.html');
				}
				else{
					$('#resultado').html('No se encontraron Coincidencias');
				}
			}
        });
	};
    
    this.drop = function(id,row){
		var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "deleteProducto",
        "id" : id
        };
        $.ajax({
			data:  parametros,
			url:   '../api/inventario.php',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
			},
			success:  function (response) {
				var obj = JSON.parse(response);
				if(obj.status=='true'){
					$('#resultado').html('');
					alert("Respuesta: "+obj.message);
					config.Intoredirect('inventario/productos.html');
					producto.PrintTable();
				}
				else{
					$('#resultado').html('Hay problemas con el internet');
				}
			}
        });	
	};

    //inicializa los input focus
	this.FocusForm = function(input,next,fin){
		if(fin=="no"){ //indica si next es el ultimo (el boton)
			$("#"+input).keypress(function(e) {
		       if(e.which == 13) {
		          // Acciones a realizar, por ej: enviar formulario.
		          if(producto.Validate(input)==false){ //accion para validar el input
		          	$('#'+input).focus();
		          }
		          else{
		          	$("#resultado").html("");
		          	$('#'+next).focus();
		          }		          
		       }
		    });
		}		
	};

	//validar los input con respecto a espacios o si se encuentra o no en la base de datos
	this.Validate = function(input){
		var text = $('#'+input).val();//traer el dato
		if(text==''){ //texto vacio
			$("#resultado").html("Campo "+input+" no puede ser vacio");
			return false;
		}
		if(text.length>100){ //limitacion de caracteres
			$("#resultado").html("Campo "+input+" no puede tener más de 15 caracteres");
			return false;
		}
	};
}