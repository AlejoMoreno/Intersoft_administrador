var lotes = new Lotes();

function Lotes(){

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
        $('#id_referencia').val(data.id_referencia);
		$('#numero_lote').val(data.numero_lote);
		$('#fecha_vence_lote').val(data.fecha_vence_lote);
		$('#ubicacion').val(data.ubicacion);
        $('#serie').val(data.serie);
        $('#cantidad').val(data.cantidad);
        $('#id_sucursal').val(data.id_sucursal);
        $('input[type="submit"]').attr('disabled','disabled');
    };

    this.sendUpdate = function(){
        parametros = {
            "id" : $('#id').val(),
            "id_referencia" : $('#id_referencia').val(),
			"numero_lote" : $('#numero_lote').val(),
			"fecha_vence_lote" : $('#fecha_vence_lote').val(),
			"ubicacion" : $('#ubicacion').val(),
            "serie" : $('#serie').val(),
            "cantidad" : $('#cantidad').val(),
            "id_sucursal" : $('#id_sucursal').val()
        };
        $.ajax({
			data:  parametros,
			url:   '/inventario/lotes/update',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
                console.log(response);
                config.Redirect('/inventario/lotes');
			}
        });
    }

}