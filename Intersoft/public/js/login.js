/*
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+
+	LOGIN.JS: En este javascript se encontrara el metodo para traer los 
+	datos y validarlos. Para poder ir a el menu principal de la aplicacion
+	
+	copyrigth@intersof 2017 by FAMC
+
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/

var login = new Login();

function Login(){
	//inicializacion de variables 
	var $Id_usuario;
	var $ncedula;
	var $Nombre;
	var $Apellido;
	var $Cargo;
	var $Telefono;
	var $Password;
	var $Correo;
	var $Estado;

	//inicializa los input focus
	this.FocusForm = function(input,next,fin){
		if(fin=="no"){ //indica si next es el ultimo (el boton)
			$("#"+input).keypress(function(e) {
		       if(e.which == 13) {
		          // Acciones a realizar, por ej: enviar formulario.
		          if(login.Validate(input)==false){ //accion para validar el input
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
		if(text.length>15){ //limitacion de caracteres
			$("#resultado").html("Campo "+input+" no puede tener más de 15 caracteres");
			return false;
		}
	};

	this.loguearse = function(){
		var parametros = {
        "cedula" : $('#cedula').val(),
        "password" : $('#password').val()
        };
        $.ajax({
			data:  parametros,
			url:   HOST+'/login',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="assets/img/loading-13.gif" style="margin-top: 20%;"></div></center>');
			},
			success:  function (response) {
				console.log(response);
				if(response.result=='success'){
					config.saveLogin(response.body,response.sessions);
					$('#resultado').html('');		
					config.Redirect('/layout');			
				}
				else{
					$('#resultado').html(response.body);
				}
			}
        });
	};
}