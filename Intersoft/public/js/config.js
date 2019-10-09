/*
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+
+	CONFIG JS: Este indicara las configuaraciones iniciales de la 
+	aplicacion, en el se vera reflejado la traida de la informacion
+	de la empresa que usa el sistemay de otros tipos de paramentros
+	que no se guardan en la base de datos, sino por cada instalacion.
+	
+	copyrigth@intersof 2017 by FAMC
+
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/
//namespace
var HOST = "http://localhost:8000";

var config = new Config();

function Config(){
	//inicializacion de variables para el objeto Empresa
	var Id_empresa;
	var Razon_social;
	var Direccion;
	var Actividad;
	var Dian_nit;
	var Nit_empresa;
	var Nombre;
	var Telefono;
	var Telefono1;
	var Telefono2;
	var Id_ciudad;
	var Id_regimen;
	var obj;
	var clave_administrador;

	this.getClave = function(){
		this.clave_administrador = "administrador";
		return this.clave_administrador;
	};

	//funcion para tomar todos los datos de la base
	this.GetAllInformation = function(){
		
		var paramentros = {
			"Autorization" : "92383af3b97f5e992ab9050693941816",
			"function" : "GetAll"
			};
		 $.ajax({
	        data:  paramentros,
	        url:   HOST+'/api/Empresa/controller.php',
	        type:  'post',
	        beforeSend: function () {
	            //alert('espere');
	        },
	        success:  function (response) {
	        	EmpresaObject = JSON.parse(response);
	            //almacenar en las variables
				this.Id_empresa = EmpresaObject['message'][0]['Id_empresa'];
				localStorage.setItem("Id_empresa", this.Id_empresa);
				this.Razon_social = EmpresaObject['message'][0]['Razon_social'];
				localStorage.setItem("Razon_social", this.Razon_social);
				this.Direccion = EmpresaObject['message'][0]['Direccion'];
				this.Actividad = EmpresaObject['message'][0]['Actividad'];
				this.Dian_nit = EmpresaObject['message'][0]['Dian_nit'];
				this.Nit_empresa = EmpresaObject['message'][0]['Nit_empresa'];
				localStorage.setItem("Nit_empresa", this.Nit_empresa);
				this.Nombre = EmpresaObject['message'][0]['Nombre'];
				this.Telefono = EmpresaObject['message'][0]['Telefono'];
				localStorage.setItem("Telefono", this.Telefono);
				this.Telefono1 = EmpresaObject['message'][0]['Telefono1'];
				this.Telefono2 = EmpresaObject['message'][0]['Telefono2'];
				this.Id_ciudad = EmpresaObject['message'][0]['Id_ciudad'];
				localStorage.setItem("Id_ciudad", this.Id_ciudad);
				this.Id_regimen = EmpresaObject['message'][0]['Id_regimen'];

				$('#empresaConfig').html("Bienvenido a Intersoft "+this.Razon_social);
	        }
		});
	};

	//redireccionar a otra pagina
	this.Redirect = function(url){
		console.log("ir a:"+url);
		$('#cargando').show();
        window.location=url;
	};

	//redireccionar adentro del dashboard
	this.Intoredirect = function(url){
		$('#contenido').html('');
        $('#contenido').load(url);
	};

	//open new window
	this.openredirect = function(url){
		window.open(url, url, "width=300, height=200")
	};

	//guardar informacion del login en dos partes como variable y como data del navegador
	this.saveLogin = function(obj,user_agent){
		console.log("saveLogin : "+obj.nombre+" "+obj.correo);

		//localStorage.getItem("correo");
		localStorage.setItem("Id_usuario", obj.id);
		localStorage.setItem("ncedula", obj.ncedula);
		localStorage.setItem("Nombre", obj.nombre);
		localStorage.setItem("Apellido", obj.apellido);
		localStorage.setItem("Cargo", obj.cargo);
		localStorage.setItem("Telefono", obj.telefono);
		localStorage.setItem("Password", obj.password);
		localStorage.setItem("Correo", obj.correo);
		localStorage.setItem("Estado", obj.estado);
		localStorage.setItem("Token", obj.token);
		localStorage.setItem("user_agent", user_agent);
		swal("Hola "+obj.nombre+" "+obj.apellido+" Estamos preparando el entono para que hagas uso de Intersof.");
		
	};

	this.saveErrorLogin = function(obj,){
		swal("Error", obj, "warning", {
				  button: "Aceptar",
				});
	}

	//cerrar sesion
	this.deleteLogin = function(){
		console.log("deleteLogin");
		//localStorage.getItem("correo");
		swal("Adios "+localStorage.setItem("Nombre", "")+" "+localStorage.setItem("Apellido", "")+" Esperamos que Intersoft halla solucionado tus problemas.");
		localStorage.setItem("Id_usuario", "");
		localStorage.setItem("ncedula", "");
		localStorage.setItem("Nombre", "");
		localStorage.setItem("Apellido", "");
		localStorage.setItem("Cargo", "");
		localStorage.setItem("Telefono", "");
		localStorage.setItem("Password", "");
		localStorage.setItem("Correo", "");
		localStorage.setItem("Estado", "");
		//redireccionar
		location.assign("login.html");
	};

	//uppercase
	this.UperCase = function(id){
		var x = document.getElementById(id);
   	 	x.value = x.value.toUpperCase();
	};

	//ajax send POST
	this.httpPost = function(parametros, url_api, contenedor){
		this.obj = '';
		$.ajax({
			data:  parametros,
			url:   url_api,
			type:  'POST',
			beforeSend: function () {
				$('#'+contenedor).html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="images/cargando.gif" style="margin-top: 20%;"></div></center>');
			},
			success:  function (response) {
				this.obj = JSON.parse(response);
				if(this.obj.status=='true'){
					$('#'+contenedor).html('');
					console.log(this.obj.message);
					//obj es universal se puede tomar desde cualquier archivo JS
				}
				else{
					$('#'+contenedor).html('Hay problemas con el internet');
				}
			}
		});
	};

	this.doSearch = function()
	{
		var tableReg = document.getElementById('datos');
		var searchText = document.getElementById('searchTerm').value.toLowerCase();
		var cellsOfRow="";
		var found=false;
		var compareWith="";

		// Recorremos todas las filas con contenido de la tabla
		for (var i = 1; i < tableReg.rows.length; i++)
		{
			cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
			found = false;
			// Recorremos todas las celdas
			for (var j = 0; j < cellsOfRow.length && !found; j++)
			{
				compareWith = cellsOfRow[j].innerHTML.toLowerCase();
				// Buscamos el texto en el contenido de la celda
				if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1))
				{
					found = true;
				}
			}
			if(found)
			{
				tableReg.rows[i].style.display = '';
			} else {
				// si no ha encontrado ninguna coincidencia, esconde la
				// fila de la tabla
				tableReg.rows[i].style.display = 'none';
			}
		}
	};

	//funcion para enviar por post
	this.send_post = function( _formulario, _url, _redirect )
	{
		var parametros = $(_formulario).serialize();
		console.log(parametros);
        $.ajax({
			data:  parametros,
			url:   _url,
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
                console.log(response);
                config.Redirect(_redirect);
			}
        });
	};

	//function para eliminar por post
	this.delete_get = function( _url, _obj, _redirect ){
		_obj = JSON.parse(_obj);
		console.log(_obj.id);
		var statusConfirm = confirm("¿Desea eliminar este registro?");
		if (statusConfirm == true)
		{
			$.ajax({
				url:   _url + _obj.id,
				type:  'get',
				beforeSend: function () {
					$('#resultado').html('<p>Espere porfavor</p>');
				},
				success:  function (response) {
	                console.log(response);
	                config.Redirect(_redirect);
				}
	        });
		}
		else
		{
			console.log("NO VALIDADO");
		}
		
	};


	this.zfill = function(number, width) {
	    var numberOutput = Math.abs(number); /* Valor absoluto del número */
	    var length = number.toString().length; /* Largo del número */ 
	    var zero = "0"; /* String de cero */  
	    
	    if (width <= length) {
	        if (number < 0) {
	             return ("-" + numberOutput.toString()); 
	        } else {
	             return numberOutput.toString(); 
	        }
	    } else {
	        if (number < 0) {
	            return ("-" + (zero.repeat(width - length)) + numberOutput.toString()); 
	        } else {
	            return ((zero.repeat(width - length)) + numberOutput.toString()); 
	        }
	    }
	};

	this.printDiv = function (nombreDiv) {
	     var divToPrint=document.getElementById(nombreDiv);

		  var newWin=window.open('','Print-Window');

		  newWin.document.open();

		  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

		  newWin.document.close();

		  setTimeout(function(){newWin.close();},10);
	};


	this.passFocus = function(_hasta){
		$('#'+_hasta).focus();
	};


	this.anular = function(_tipo,_data){
		var data = JSON.parse(_data);
		if(_tipo == 'factura'){
			var url = '/documentos/anular/'+data.id;
		}
		var statusConfirm = confirm("¿Desea anular este registro?");
		if (statusConfirm == true)
		{
			$.ajax({
				url:   url,
				type:  'get',
				beforeSend: function () {
					$('#resultado').html('<p>Espere porfavor</p>');
				},
				success:  function (response) {
	                console.log(response);
	                swal(response.result, response.mensaje, "success");
	                //history.back();
				}
	        });
		}
		else
		{
			swal("Alerta!", "no se realizo anulación", "danger");
			//history.back();
		}

	}


	this.eliminar = function(_tipo,_data){
		var data = JSON.parse(_data);
		if(_tipo == 'factura'){
			var url = '/documentos/eliminar/'+data.id;
		}
		var statusConfirm = confirm("¿Desea eliminar este registro?");
		if (statusConfirm == true)
		{
			$.ajax({
				url:   url,
				type:  'get',
				beforeSend: function () {
					$('#resultado').html('<p>Espere porfavor</p>');
				},
				success:  function (response) {
	                console.log(response);
	                swal(response.result, response.mensaje, "success");
	                //history.back();
				}
	        });
		}
		else
		{
			swal("Alerta!", "no se realizo Eliminación", "danger");
			//history.back();
		}

	}

}

