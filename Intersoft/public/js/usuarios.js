/*
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+
+	USUARIOS JS: Este indicara las funciones iniciales de las Usuarios
+ 	en javascript.
+	
+	copyrigth@intersof 2017 by FAMC
+
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/
var JsonUsuarios;
var JsonUsuariosUpdate;
var usuarios = new Usuarios();

function Usuarios(){
	this.addusuarios = function(){
	    $('#formularioUsuarios').show(500);
	    $('#tablaUsuarios').hide();
	    $('#from-update').hide();
	};

	this.guardarusuarios = function(){
	    var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "guardarusuarios",
        "ncedula" : $('#ncedula').val(),
		"Nombre" : $('#nombre').val(),
		"Apellido" : $('#apellido').val(),
		"Cargo" : $('#cargo').val(),
		"Telefono" : $('#telefono').val(),
		"Password" : $('#password').val(),
		"Correo" : $('#correo').val(),
		"Estado" : $('#estado').val()
        };
        $.ajax({
			data:  parametros,
			url:   '../api/usuarios.php',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
			},
			success:  function (response) {
				console.log(response);
				var obj = JSON.parse(response);
				if(obj.status=='true'){
					$('#resultado').css("color","green").html(obj.message);
					config.Intoredirect('administrador/usuarios.html');
				}
				else{
					$('#resultado').html('No se encontraron Coincidencias');
				}
			}
        });
	};

	this.updateusuarios = function(){
		var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "updateusuarios",
        "ncedula" : $('#upncedula').val(),
		"Nombre" : $('#upnombre').val(),
		"Apellido" : $('#upapellido').val(),
		"Cargo" : $('#upcargo').val(),
		"Telefono" : $('#uptelefono').val(),
		"Password" : $('#uppassword').val(),
		"Correo" : $('#upcorreo').val(),
		"Estado" : $('#upestado').val()
        };
        $.ajax({
			data:  parametros,
			url:   '../api/usuarios.php',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
			},
			success:  function (response) {
				console.log(response);
				var obj = JSON.parse(response);
				if(obj.status=='true'){
					alert('Respuesta: '+obj.message);
					config.Intoredirect('administrador/usuarios.html');
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
        "function" : "GetParticularUsuario",
        "id": id
        };
        $.ajax({
			data:  parametros,
			url:   '../api/usuarios.php',
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
				    	console.log(obj.message);
				    	$('#from-update').show();
				    	$('#upid_usuario').val(obj.message[0].Id_usuario);
						$('#updatencedula').val(obj.message[0].ncedula);
						$('#updatenombre').val(obj.message[0].Nombre);
						$('#updateapellido').val(obj.message[0].Apellido);
						$('#updatecargo').val(obj.message[0].Cargo);
						$('#updatetelefono').val(obj.message[0].Telefono);
						$('#updatepassword').val(obj.message[0].Password);
						$('#updatecorreo').val(obj.message[0].Correo);
						$('#updateestado').val(obj.message[0].Estado);
				    }
				}
				else{
					$('#resultado').html('Hay problemas con el internet');
				}
			}
        });		
	};

	this.searchusuarios = function(){
		var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "getAllUsuarios"
        };
        $.ajax({
			data:  parametros,
			url:   '../api/usuarios.php',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
			},
			success:  function (response) {
				var obj = JSON.parse(response);
				if(obj.status=='true'){
					$('#resultado').html('');
					console.log(obj.message);
					usuarios.PrintTable(obj.message);
				}
				else{
					$('#resultado').html('Hay problemas con el internet');
				}
			}
        });		
	};

	this.PrintTable = function(json){
		$('#formularioUsuarios').hide();
	    $('#tablaUsuarios').show(500);
	    if(json != undefined){
		    //recorrer para escibir la tabla con los datos de las USUARIOS
		    $("#tableusuarios tr").remove();//vaciar la tabla
		    $("#tableusuarios").append("<thead> <th>ID</th> <th>Correo</th> <th>Nombres</th> <th>Cargo</th> <th>Teléfono</th> <th></th> <th></th> </thead>");
		    var table = document.getElementById("tableusuarios"); //se toma como objeto la tabla de USUARIOS
		    for (var i = 0; i < json.length; i++) { //se recorre el json
		    	var row 		= table.insertRow(); // insertar fila
		    	var id 			= row.insertCell(0); //insertar celdas
			    var Correo 		= row.insertCell(1); //insertar celdas
			    var Nombres 	= row.insertCell(2); //insertar celdas
			    var Cargo 		= row.insertCell(3); //insertar celdas
			    var Telefono 	= row.insertCell(4); //insertar celdas
			    var update 		= row.insertCell(5); //insertar celdas
			    var drop 		= row.insertCell(6); //insertar celdas
			    id.innerHTML 		= i+1; //poner el nombre de la celda
				Nombres.innerHTML 	= json[i].Nombre; //poner el nombre de la celda
				Correo.innerHTML 	= json[i].Correo; //poner el nombre de la celda
				Cargo.innerHTML 	= json[i].Cargo; //poner el nombre de la celda
				Cargo.innerHTML 	= json[i].Telefono; //poner el nombre de la celda
			    Telefono.innerHTML 	= '<button onclick="usuarios.GetParticular('+json[i].Id_usuario+');" class="btn btn-warning">></button>'; //poner el nombre de la celda
			    drop.innerHTML 		= '<button onclick="usuarios.drop('+json[i].Id_usuario+','+(i+1)+');" class="btn btn-danger">x</button>'; //poner el nombre de la celda
		    }
	    }
	};

	this.drop = function(id,row){
		var parametros = {
        "Autorization" : "92383af3b97f5e992ab9050693941816",
        "function" : "deleteUsuarios",
        "id" : id
        };
        $.ajax({
			data:  parametros,
			url:   '../api/usuarios.php',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
			},
			success:  function (response) {
				var obj = JSON.parse(response);
				if(obj.status=='true'){
					$('#resultado').html('');
					alert("Respuesta: USUARIOS "+obj.message);
					config.Intoredirect('administrador/usuarios.html');
					usuarios.searchusuarios();
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