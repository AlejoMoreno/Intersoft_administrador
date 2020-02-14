var tipopagos = new TipoPagos();

function TipoPagos(){

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
        $('#puc_cuenta').val(data.puc_cuenta.id);
        $('#tercero').val(data.tercero);
		$('input[type="submit"]').attr('disabled','disabled');
    };

    this.sendUpdate = function(){
        parametros = {
            "id" : $('#id').val(),
            "nombre" : $('#nombre').val(),
			"puc_cuenta" : $('#puc_cuenta').val(),
            "tercero" : $('#tercero').val()
        };
        $.ajax({
			data:  parametros,
			url:   '/administrador/tipopagos/update',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
                console.log(response);
                config.Redirect('/administrador/tipopagos');
			}
        });
    }

}