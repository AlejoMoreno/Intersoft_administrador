var clasificaciones = new Clasificaciones();

function Clasificaciones(){

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
		$('#cuenta_contable').val(data.cuenta_contable);
        $('input[type="submit"]').attr('disabled','disabled');
    };

    this.sendUpdate = function(){
        parametros = {
            "id" : $('#id').val(),
            "nombre" : $('#nombre').val(),
			"descripcion" : $('#descripcion').val(),
			"cuenta_contable" : $('#cuenta_contable').val()
        };
        $.ajax({
			data:  parametros,
			url:   '/inventario/clasificaciones/update',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
                console.log(response);
                config.Redirect('/inventario/clasificaciones');
			}
        });
    }

}