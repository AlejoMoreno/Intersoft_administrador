/*
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+
+	PERFIL JS: Este indicara las funciones javascript del perfil. 
+	
+	copyrigth@intersof 2017 by FAMC
+
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/

var perfil = new Perfil();

function Perfil(){
	//realizar cambio de contraseña

	this.changePass = function(password,rePassword,id){
		if(password!=rePassword){
			$("#resultado").html("No coinciden las contraseñas");
		}
		else{
			var parametros = {
	        "Autorization" : "92383af3b97f5e992ab9050693941816",
	        "function" : "changePass",
	        "rePassword" : rePassword,
	        "password" : password,
	        "id" : id
	        };
	        $.ajax({
				data:  parametros,
				url:   '../api/controller.php',
				type:  'post',
				beforeSend: function () {
					$('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
				},
				success:  function (response) {
					console.log(response);
					var obj = JSON.parse(response);
					if(obj.status=='true'){
						$('#resultado').html(obj.message);
					}
					else{
						$('#resultado').html('No se encontraron Coincidencias');
					}
				}
	        });
		}		
	};

	//inicializa los input focus
	this.FocusForm = function(input,next,fin){
		if(fin=="no"){ //indica si next es el ultimo (el boton)
			$("#"+input).keypress(function(e) {
		       if(e.which == 13) {
		          // Acciones a realizar, por ej: enviar formulario.
		          if(perfil.Validate(input)==false){ //accion para validar el input
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
}