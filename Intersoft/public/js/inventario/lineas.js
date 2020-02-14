var lineas = new Lineas();

function Lineas(){

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
        $('#retefuente_porcentaje').val(data.retefuente_porcentaje);
        $('#v_puc_retefuente').val(data.v_puc_retefuente.id);
        $('#c_puc_retefuente').val(data.c_puc_retefuente.id);
        $('#reteiva_porcentaje').val(data.reteiva_porcentaje);
        $('#v_puc_reteiva').val(data.v_puc_reteiva.id);
        $('#c_puc_reteiva').val(data.c_puc_reteiva.id);
        $('#reteica_porcentaje').val(data.reteica_porcentaje);
        $('#v_puc_reteica').val(data.v_puc_reteica.id);
        $('#c_puc_reteica').val(data.c_puc_reteica.id);
        $('#iva_porcentaje').val(data.iva_porcentaje);
        $('#v_puc_iva').val(data.v_puc_iva).id;
        $('#c_puc_iva').val(data.c_puc_iva.id);
        $('#puc_compra').val(data.puc_compra.id);
        $('#puc_venta').val(data.puc_venta.id);
        $('#codigo_interno').val(data.codigo_interno);
		$('#codigo_alterno').val(data.codigo_alterno);
		$('input[type="submit"]').attr('disabled','disabled');
    };

    this.sendUpdate = function(){
        parametros = {
            "id" : $('#id').val(),
            "nombre" : $('#nombre').val(),
            "descripcion" : $('#descripcion').val(),
            "retefuente_porcentaje" : $('#retefuente_porcentaje').val(),
            "puc_retefuente" : $('#puc_retefuente').val(),
            "reteiva_porcentaje" : $('#reteiva_porcentaje').val(),
            "puc_reteiva" : $('#puc_reteiva').val(),
            "reteica_porcentaje" : $('#reteica_porcentaje').val(),
            "puc_reteica" : $('#puc_reteica').val(),
            "iva_porcentaje" : $('#iva_porcentaje').val(),
            "puc_iva" : $('#puc_iva').val(),
            "puc_compra" : $('#puc_compra').val(),
            "puc_venta" : $('#puc_venta').val(),
			"codigo_interno" : $('#codigo_interno').val(),
			"codigo_alterno" : $('#codigo_alterno').val()
        };
        $.ajax({
			data:  parametros,
			url:   '/inventario/lineas/update',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
                console.log(response);
                config.Redirect('/inventario/lineas');
			}
        });
    }

}