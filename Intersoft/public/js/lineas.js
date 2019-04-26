/*
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+
+	lineas JS: Este indicara las funciones iniciales de las lineas
+ 	en javascript.
+	
+	copyrigth@intersof 2017 by FAMC
+
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/
var JsonLineas;
var JsonLineasUpdate;
var lineas = new Lineas();

function Lineas(){


	this.addLineas = function(){
	    $('#formularioLineas').show(500);
	    $('#tablaLineas').hide();
	};

	this.searchlineas = function(){
		$('#formularioLineas').hide();
	    $('#tablaLineas').show(500);
	};

	this.guardarLineas = function(){
	    var parametros = {			
			"nombre" : $('#nombre').val(),
			"descripcion" : $('#descripcion').val()
		};
		$.ajax({
			data:  parametros,
			url:   HOST+'/login',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
			},
			success:  function (response) {
				console.log(response);
				if(response.result=='success'){
					config.saveLogin(response.body[0]);
					$('#resultado').html('');		
					config.Redirect('/layout');			
				}
				else{
					$('#resultado').html(response.body);
				}
			}
		});
	};

	this.updateLineas = function(){
		var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "updateLineas",
        "id" : $('#upid_linea').val(),
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
					config.Intoredirect('inventario/lineas.html');
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
        "function" : "GetParticularLineas",
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
				    	console.log(JsonLineasUpdate);
				    	$('#from-update').show();
				    	$('#upid_linea').val(obj.message[0].Id_linea);
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

	this.PrintTable = function(json){
		$('#formularioLineas').hide();
	    $('#tablaLineas').show(500);
	    if(json != undefined){
	    	console.log(json);
		    //recorrer para escibir la tabla con los datos de las lineas
		    $("#tablelineas tr").remove();//vaciar la tabla
		    $("#tablelineas").append("<thead> <th>ID</th> <th>Nombre</th> <th>Descripcion</th> <th></th> <th></th> </thead>");
		    var table = document.getElementById("tablelineas"); //se toma como objeto la tabla de lineas
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
			    update.innerHTML 	= '<button onclick="lineas.GetParticular('+json[i].Id_linea+');" class="btn btn-warning">></button>'; //poner el nombre de la celda
			    drop.innerHTML 		= '<button onclick="lineas.drop('+json[i].Id_linea+','+(i+1)+');" class="btn btn-danger">x</button>'; //poner el nombre de la celda
		    }
	    }
	};

	this.drop = function(id,row){
		var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "deleteLineas",
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
					config.Intoredirect('inventario/lineas.html');
					lineas.getAllLineas();
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
		          if(lineas.Validate(input)==false){ //accion para validar el input
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