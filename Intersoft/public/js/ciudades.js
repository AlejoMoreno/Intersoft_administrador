/*
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
+
+	Ciudades JS: Este indicara las configuaraciones iniciales de la 
+	aplicacion, en el se vera reflejado la traida de la informacion
+	de la empresa que usa el sistemay de otros tipos de paramentros
+	que no se guardan en la base de datos, sino por cada instalacion.
+	
+	copyrigth@intersof 2017 by FAMC
+
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/

var ciudades = new Ciudades();

//inicial
ciudades.allDepartamentos();

function Ciudades(){

    this.departamentos = function(){
        var id = $('#id_departamento').val();
		$.ajax({
			url:   HOST+'/ciudades/departamento/'+id,
			type:  'get',
			beforeSend: function () {
				$('#resultado').html('<p style="color:green">Buscando Resultados</p>');
			},
			success:  function (response) {
				console.log(response);
			}
		});
    };

    this.allDepartamentos = function(){
        $.ajax({
			url:   HOST+'/departamentos/all',
			type:  'get',
			beforeSend: function () {
				$('#resultado').html('<p style="color:green">Buscando Resultados</p>');
			},
			success:  function (response) {
                console.log(response);
                var Departamentos = response.body;
                Departamentos.forEach(function(element) {
                    $('#id_departamento').append('<option value="'+element['id']+'">'+element['nombre']+'</option>');
                }, this);
			}
		});
    };
}