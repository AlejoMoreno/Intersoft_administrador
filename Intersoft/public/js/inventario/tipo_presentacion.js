var tipo_presentacion = new Tipo_presentacion();

function Tipo_presentacion(){

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
        $('#nombre').val(data.nombre);
		$('#descripcion').val(data.descripcion);
		$('input[type="submit"]').attr('disabled','disabled');
    };

    this.sendUpdate = function(){
        parametros = {
            "id" : $('#id').val(),
            "nombre" : $('#nombre').val(),
			"descripcion" : $('#descripcion').val()
        };
        $.ajax({
			data:  parametros,
			url:   '/inventario/tipo_presentaciones/update',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
                console.log(response);
                config.Redirect('/inventario/tipo_presentaciones');
			}
        });
    }

}