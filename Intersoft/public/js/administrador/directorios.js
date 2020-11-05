var directorios = new Directorios();

function Directorios(){
	this.init = function(){

	}
	//funciona unicamente con inputs
	this.buscar = function(){
		$('#clientes_encontrados').html('');
		parametros = {
            "razon_social" : $('#razon_social').val(),
            "nit" : $('#nit').val(),
			"correo" : $('#correo').val(),
			"tipo" : $('select[name="id_directorio_tipo_tercero"] option:selected').text()
        };
        $.ajax({
			data:  parametros,
			url:   '/administrador/diretorios/search/search',
			type:  'post',
			beforeSend: function () {
				$('#resultado').css('display','inline');
			},
			success:  function (response) {
                console.log(response.body);
                $('#clientes_encontrados').append('<table class="table table-hover table-striped" id="tabla" >'+
		              '<thead>'+
		                  '<tr>'+
		                    '<th>Nit</th>'+
		                    '<th>Razón social</th>'+
		                    '<th>Direccion</th>'+
		                    '<th>Correo</th>'+
		                    '<th>Teléfono</th>'+
		                    '<th>Tipo</th>'+
		                  '</tr>'+
		              '</thead><tbody>');
                $.each( response.body, function( key, value ) {
					$('#tabla').append('<tr onclick="directorios.update(`'+value.id+'`);">'+
						'<td>'+value.nit+'</td>'+
	                    '<td>'+value.razon_social+'</td>'+
	                    '<td>'+value.direccion+'</td>'+
	                    '<td>'+value.correo+'</td>'+
	                    '<td>'+value.telefono+'</td>'+
	                    '<td>'+value.id_directorio_tipo_tercero.nombre+'</td>'+
	                  '</tr>');
				});
				$('#tabla').append('</tbody></table>');
				$('#tabla').DataTable( {
					dom: 'Bfrtip',
					buttons: [
						'copy', 'csv', 'excel', 'pdf', 'print'
					]
				} );
				$('#resultado').css('display','none');
			}
        });
	}

	this.update = function(data){
        $.ajax({
			url:   '/administrador/directorios/'+data,
			type:  'get',
			beforeSend: function () {
				$('#resultado').css('display','inline');
			},
			success:  function (response) {
				console.log(response);
				//ubicarlos en cada casilla input
				$('#id').val(response.body.id);
				$('#nit').val(response.body.nit);
				$('#digito').val(response.body.digito);
				$('#razon_social').val(response.body.razon_social);
				$('#direccion').val(response.body.direccion);
				$('#correo').val(response.body.correo);
				$('#telefono').val(response.body.telefono);
				$('#telefono1').val(response.body.telefono1);
				$('#telefono2').val(response.body.telefono2);
				$('#financiacion').val(response.body.financiacion);
				$('#descuento').val(response.body.descuento);
				$('#cupo_financiero').val(response.body.cupo_financiero);
				$('#rete_ica').val(response.body.rete_ica);
				$('#porcentaje_rete_iva').val(response.body.porcentaje_rete_iva);
				$('#actividad_economica').val(response.body.actividad_economica);
				$('#calificacion').val(response.body.calificacion);
				$('#nivel').val(response.body.nivel);
				$('#zona_venta').val(response.body.zona_venta);
				$('#transporte').val(response.body.transporte);
				$('#estado').val(response.body.estado);
				$('#id_retefuente').val(response.body.id_retefuente);
				$('#id_ciudad').val(response.body.id_ciudad);
				$('#id_regimen').val(response.body.id_regimen);
				$('#id_usuario').val(response.body.id_usuario);
				$('#id_directorio_tipo').val(response.body.id_directorio_tipo);
				$('#id_directorio_clase').val(response.body.id_directorio_clase);
				$('#id_directorio_tipo_tercero').val(response.body.id_directorio_tipo_tercero);
				//desaparecer modal 
				$('#btnguardar').hide();
				$('#butonmodal').trigger('click');
				$('#resultado').css('display','none');
			}
        });
	}

	this.sendUpdate = function(){
		var id = $('#id').val();
    	if(id != ''){
    		parametros = {
	        	"id" : $('#id').val(),
				"nit" : $('#nit').val(),
				"digito" : $('#digito').val(),
				"razon_social" : $('#razon_social').val(),
				"direccion" : $('#direccion').val(),
				"correo" : $('#correo').val(),
				"telefono" : $('#telefono').val(),
				"telefono1" : $('#telefono1').val(),
				"telefono2" : $('#telefono2').val(),
				"financiacion" : $('#financiacion').val(),
				"descuento" : $('#descuento').val(),
				"cupo_financiero" : $('#cupo_financiero').val(),
				"rete_ica" : $('#rete_ica').val(),
				"porcentaje_rete_iva" : $('#porcentaje_rete_iva').val(),
				"actividad_economica" : $('#actividad_economica').val(),
				"calificacion" : $('#calificacion').val(),
				"nivel" : $('#nivel').val(),
				"zona_venta" : $('#zona_venta').val(),
				"transporte" : $('#transporte').val(),
				"estado" : $('#estado').val(),
				"id_retefuente" : $('#id_retefuente').val(),
				"id_ciudad" : $('#id_ciudad').val(),
				"id_regimen" : $('#id_regimen').val(),
				"id_usuario" : $('#id_usuario').val(),
				"id_directorio_tipo" : $('#id_directorio_tipo').val(),
				"id_directorio_clase" : $('#id_directorio_clase').val(),
				"id_directorio_tipo_tercero" : $('#id_directorio_tipo_tercero').val()
	            
	        };
	        $.ajax({
				data:  parametros,
				url:   '/administrador/directorios/update',
				type:  'post',
				beforeSend: function () {
					$('#resultado').html('<p>Espere porfavor</p>');
				},
				success:  function (response) {
	                console.log(response);
					swal({
						title: "Correcto",
						text: "Guardo con exito",
						icon: "success",
						buttons: true,
						dangerMode: true,
						})
						.then((willDelete) => {
						if (willDelete) {
							location.reload();
						} else {
							location.reload();
						}
					}); 
				}
	        });
    	}
    	else{
			$('#resultado').hide();
                swal({
                    title: "Algo anda mal",
                    text: 'No puedes actualizar sin haber buscado un tercero',
                    icon: "error",
                    button: "Aceptar",
                });
    	}
        
    }

    this.eliminar = function(){
    	var id = $('#id').val();
    	if(id != ''){
    		var statusConfirm = confirm("¿Desea eliminar este registro?");
			if (statusConfirm == true)
			{
	    		config.Redirect('/administrador/directorios/delete/'+id  );
	    	}
	    	else{
	    		console.log("NO VALIDADO");
	    	}
    	}
    	else{
    		alert('No puedes eliminar sin haber buscado el tercero');
    	}
    	
	}
	
	this.envioExcel = function(){
		var id_directorio_tipo_tercero = $('#id_directorio_tipo_tercero').val();
		var id_directorio_clase = $('#id_directorio_clase').val();
		var id_ciudad = $('#id_ciudad').val();
		var calificacion = $('#calificacion').val();
		var nivel = $('#nivel').val();
		var estado = $('#estado').val();
		var id_retefuente = $('#id_retefuente').val();
		var id_regimen = $('#id_regimen').val();
		config.Redirect("/excel/excelDirectorio?id_directorio_tipo_tercero="+id_directorio_tipo_tercero+
		"&id_directorio_clase"+id_directorio_clase+
		"&calificacion="+calificacion+
		"&nivel="+nivel+
		"&estado="+estado+
		"&id_retefuente="+id_retefuente+
		"&id_retefuente="+id_retefuente+
		"&id_regimen="+id_regimen+
		"&id_ciudad="+id_ciudad);
	}

	this.envioPDF = function(){
		var id_directorio_tipo_tercero = $('#id_directorio_tipo_tercero').val();
		var id_directorio_clase = $('#id_directorio_clase').val();
		var id_ciudad = $('#id_ciudad').val();
		var calificacion = $('#calificacion').val();
		var nivel = $('#nivel').val();
		var estado = $('#estado').val();
		var id_retefuente = $('#id_retefuente').val();
		var id_regimen = $('#id_regimen').val();
        config.Redirect("/pdf/pdfDirectorio?id_directorio_tipo_tercero="+id_directorio_tipo_tercero+
		"&calificacion="+calificacion+
		"&id_directorio_clase"+id_directorio_clase+
		"&nivel="+nivel+
		"&estado="+estado+
		"&id_retefuente="+id_retefuente+
		"&id_retefuente="+id_retefuente+
		"&id_regimen="+id_regimen+
		"&id_ciudad="+id_ciudad);
	}
}