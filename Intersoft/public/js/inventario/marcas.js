var marcas = new Marcas();

function Marcas(){

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
        $('#logo').val(data.logo);
        $('#codigo_interno').val(data.codigo_interno);
		$('#codigo_alterno').val(data.codigo_alterno);
		$('input[type="submit"]').attr('disabled','disabled');
    };

    this.sendUpdate = function(){
        parametros = {
            "id" : $('#id').val(),
            "nombre" : $('#nombre').val(),
            "descripcion" : $('#descripcion').val(),
            "logo" : $('#logo').val(),
			"codigo_interno" : $('#codigo_interno').val(),
			"codigo_alterno" : $('#codigo_alterno').val()
        };
        $.ajax({
			data:  parametros,
			url:   '/inventario/marcas/update',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
                console.log(response);
                config.Redirect('/inventario/marcas');
			}
        });
    }

}