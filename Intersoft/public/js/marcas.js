/*
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+
+	MARCAS JS: Este indicara las funciones iniciales de las marcas
+ 	en javascript.
+	
+	copyrigth@intersof 2017 by FAMC
+
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/
var JsonMarcas;
var JsonMarcasUpdate;
var marcas = new Marcas();

function Marcas(){
	this.addMarcas = function(){
	    $('#formularioMarcas').show(500);
	    $('#tablaMarcas').hide();
	    $('#from-update').hide();
	};

	this.guardarMarcas = function(){
	    var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "guardarMarcas",
        "nombre" : $('#nombre').val(),
        "descripcion" : $('#descripcion').val()
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
					$('#nombre').val('');
					$('#descripcion').val('');
					config.Intoredirect('inventario/marcas.html');
				}
				else{
					$('#resultado').html('No se encontraron Coincidencias');
				}
			}
        });
	};

	this.updateMarcas = function(){
		var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "updateMarcas",
        "id" : $('#upid_marca').val(),
        "nombre" : $('#upnombre').val(),
        "descripcion" : $('#updescripcion').val()
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
					alert('Respuesta: '+obj.message);
					config.Intoredirect('inventario/marcas.html');
				}
				else{
					$('#resultado').html('No se encontraron Coincidencias');
				}
			}
        });
	};

	this.GetParticular = function(id){
		var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "GetParticular",
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
				    	$('#from-update').show();
				     	$('#upid_marca').val(obj.message[0].Id_marca);
						$('#upnombre').val(obj.message[0].Nombre);
						$('#updescripcion').val(obj.message[0].Descripcion);
				    }
				}
				else{
					$('#resultado').html('Hay problemas con el internet');
				}
			}
        });		
	};

	this.searchMarcas = function(){
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
					$('#resultado').html('');
					//console.log(obj.message);
					marcas.PrintTable(obj.message);
				}
				else{
					$('#resultado').html('Hay problemas con el internet');
				}
			}
        });		
	};

	this.PrintTable = function(json){
		$('#formularioMarcas').hide();
	    $('#tablaMarcas').show(500);
	    if(json != undefined){
	    	console.log(json);
		    //recorrer para escibir la tabla con los datos de las marcas
		    $("#tablemarcas tr").remove();//vaciar la tabla
		    $("#tablemarcas").append("<thead> <th>ID</th> <th>Nombre</th> <th>Descripcion</th> <th></th> <th></th> </thead>");
		    var table = document.getElementById("tablemarcas"); //se toma como objeto la tabla de marcas
		    for (var i = 0; i < json.length; i++) { //se recorre el json
		    	var row 		= table.insertRow(); // insertar fila
		    	var id 			= row.insertCell(0); //insertar celdas
			    var nombre 		= row.insertCell(1); //insertar celdas
			    var descripcion = row.insertCell(2); //insertar celdas
			    var update 		= row.insertCell(3); //insertar celdas
			    var drop 		= row.insertCell(4); //insertar celdas
			    id.innerHTML 		= i+1; //poner el nombre de la celda
			    nombre.innerHTML 	= json[i].Nombre; //poner el nombre de la celda
			    descripcion.innerHTML = json[i].Descripcion; //poner el nombre de la celda
			    update.innerHTML 	= '<button onclick="marcas.GetParticular('+json[i].Id_marca+');" class="btn btn-warning">></button>'; //poner el nombre de la celda
			    drop.innerHTML 		= '<button onclick="marcas.drop('+json[i].Id_marca+','+(i+1)+');" class="btn btn-danger">x</button>'; //poner el nombre de la celda
		    }
	    }
	};

	this.drop = function(id,row){
		var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "deleteMarcas",
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
					config.Intoredirect('inventario/marcas.html');
					marcas.getAllMarcas();
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
		          if(marcas.Validate(input)==false){ //accion para validar el input
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