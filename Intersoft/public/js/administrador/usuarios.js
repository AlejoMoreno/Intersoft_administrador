var usuarios = new Usuarios();

function Usuarios(){

    this.initial = function(){
        $('#actualizar').hide();
    };

    this.update = function( data ){
        $('#actualizar').show();
        console.log('Daatos Sucurusal-update:');
        var data = JSON.parse(data);
        console.log(data);
        $('#row'+data.id).css('opacity','0.4');
        //ubicar informacion en el formulario
        $('#id').val(data.id);
        $('#ncedula').val(data.ncedula);
		$('#nombre').val(data.nombre);
		$('#apellido').val(data.apellido);
		$('#cargo').val(data.cargo);
		$('#telefono').val(data.telefono);
		$('#password').val(data.password);
		$('#correo').val(data.correo);
		$('#estado').val(data.estado);
		$('#token').val(data.token);
		$('#arl').val(data.arl);
		$('#eps').val(data.eps);
		$('#cesantias').val(data.cesantias);
		$('#pension').val(data.pension.split(","));
		$('#caja_compensacion').val(data.caja_compensacion);
		$('#id_contrato').val(data.id_contrato.id);
		$('#referencia_personal').val(data.referencia_personal);
		$('#telefono_referencia').val(data.telefono_referencia);
        $('#btnguardar').hide();
    };

    this.sendUpdate = function(){
        parametros = {
            "id" : $('#id').val(),
            "nombre" : $('#nombre').val(),
            "codigo" : $('#codigo').val(),
            "direccion" : $('#direccion').val(),
            "encargado" : $('#encargado').val(),
            "telefono" : $('#telefono').val(),
            "correo" : $('#correo').val(),
            "ciudad" : $('#ciudad').val(),
            "id_empresa" : $('#id_empresa').val()
        };
        $.ajax({
			data:  parametros,
			url:   '/administrador/usuarios/update',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
                console.log(response);
                config.Redirect('/administrador/usuarios');
			}
        });
    }

}