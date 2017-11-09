var usuarios = new Usuarios();
function Usuarios(){

    this.update = function( data ){
        console.log('Daatos Sucurusal-update:');
        var data = JSON.parse(data);
        console.log(data);
        $('#row'+data.id).css('opacity','0.4');
        //ubicar informacion en el formulario
        $('#id').val(data.id);
        $('#nombre').val(data.nombre);
        $('#codigo').val(data.codigo);
        $('#direccion').val(data.direccion);
        $('#encargado').val(data.encargado);
        $('#telefono').val(data.telefono);
        $('#correo').val(data.correo);
        $('#ciudad').val(data.ciudad.id);
        //$('#ciudad[value='+data.ciudad.id+']').attr('selected','selected');
        $('#id_empresa').val(data.id_empresa);
        $('input[type="submit"]').attr('disabled','disabled');
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
                config.Redirect('/administrador/sucursales');
			}
        });
    }

}