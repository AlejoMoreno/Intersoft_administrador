var referencias = new Referencias();

function Referencias(){

    this.initial = function(){
        $('#actualizar').hide();
        $('#crear').hide();
        $('#tabla').show();
        $('#tabla').addClass('fadeIn');
    };

    this.crear = function(){
    	$('#tabla').hide();
    	$('#crear').show();
    	$('#crear').addClass('fadeIn');
    };

    //function para eliminar por post
	this.delete_get = function( _url, _obj, _redirect ){
		_obj = JSON.parse(_obj);
		console.log(_obj.id);
		if(_obj.saldo > 0){
			alert("no puedes eliminar este producto, ya que tiene saldo");
		}
		else{
			var statusConfirm = confirm("¿Desea eliminar este registro?");
			if (statusConfirm == true)
			{
				$.ajax({
					url:   _url + _obj.id,
					type:  'get',
					beforeSend: function () {
						$('#resultado').html('<p>Espere porfavor</p>');
					},
					success:  function (response) {
		                console.log(response);
		                config.Redirect(_redirect);
					}
		        });
			}
			else
			{
				console.log("NO VALIDADO");
			}
		}
	};

    this.update = function( data ){
        $('#actualizar').show();
        console.log('Daatos Sucurusal-update:');
        var data = JSON.parse(data);
        console.log(data);
        $('#row'+data.id).css('opacity','0.4');
        //ubicar informacion en el formulario
        $('#id').val(data.id);
        $('#codigo_linea').val(data.codigo_linea[0].id);
		$('#codigo_letras').val(data.codigo_letras);
		$('#codigo_consecutivo').val(data.codigo_consecutivo);
		$('#descripcion').val(data.descripcion);
		$('#codigo_barras').val(data.codigo_barras);
		$('#codigo_interno').val(data.codigo_interno);
		$('#codigo_alterno').val(data.codigo_alterno);
		$('#id_presentacion').val(data.id_presentacion[0].id);
		$('#id_marca').val(data.id_marca[0].id);
		$('#factor_rendimiento').val(data.factor_rendimiento);
		$('#stok_minimo').val(data.stok_minimo);
		$('#stok_maximo').val(data.stok_maximo);
		$('#iva').val(data.iva);
		$('#impo_consumo').val(data.impo_consumo);
		$('#sobre_tasa').val(data.sobre_tasa);
		$('#serie').val(data.serie);
		$('#descuento').val(data.descuento);
		$('#id_clasificacion').val(data.id_clasificacion[0].id);
		$('#peso').val(data.peso);
		$('#precio1').val(data.precio1);
		$('#precio2').val(data.precio2);
		$('#precio3').val(data.precio3);
		$('#precio4').val(data.precio4);
		$('#estado').val(data.estado);
		$('#hommologo').val(data.hommologo);
		$('#costo').val(data.costo);
		$('#costo_promedio').val(data.costo_promedio);
		$('#saldo').val(data.saldo);
		$('#usuario_creador').val(data.usuario_creador[0].id);
		$('#cuentaDB').val(data.cuentaDB[0].id);
		$('#cuentaCR').val(data.cuentaCR[0].id);
		$('input[type="submit"]').attr('disabled','disabled');
		referencias.crear();
    };

    this.sendUpdate = function(){
        parametros = {
            "id" 				: $('#id').val(),
            "codigo_linea" 		: $('#codigo_linea').val(),
			"codigo_letras" 	: $('#codigo_letras').val(),
			"codigo_consecutivo" : $('#codigo_consecutivo').val(),
			"descripcion" 		: $('#descripcion').val(),
			"codigo_barras" 	: $('#codigo_barras').val(),
			"codigo_interno" 	: $('#codigo_interno').val(),
			"codigo_alterno" 	: $('#codigo_alterno').val(),
			"id_presentacion" 	: $('#id_presentacion').val(),
			"id_marca" 			: $('#id_marca').val(),
			"factor_rendimiento" : $('#factor_rendimiento').val(),
			"stok_minimo" 		: $('#stok_minimo').val(),
			"stok_maximo" 		: $('#stok_maximo').val(),
			"iva" 				: $('#iva').val(),
			"impo_consumo" 		: $('#impo_consumo').val(),
			"sobre_tasa" 		: $('#sobre_tasa').val(),
			"serie" 			: $('#serie').val(),
			"descuento" 		: $('#descuento').val(),
			"id_clasificacion" 	: $('#id_clasificacion').val(),
			"peso" 				: $('#peso').val(),
			"precio1" 			: $('#precio1').val(),
			"precio2" 			: $('#precio2').val(),
			"precio3" 			: $('#precio3').val(),
			"precio4" 			: $('#precio4').val(),
			"estado" 			: $('#estado').val(),
			"hommologo" 		: $('#hommologo').val(),
			"costo" 			: $('#costo').val(),
			"costo_promedio" 	: $('#costo_promedio').val(),
			"saldo" 			: $('#saldo').val(),
			"cuentaDB" 			: $('#cuentaDB').val(),
			"cuentaCR" 			: $('#cuentaCR').val(),
			"usuario_creador" 	: $('#usuario_creador').val()
        };
        $.ajax({
			data:  parametros,
			url:   '/inventario/referencias/update',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
                console.log(response);
                config.Redirect('/inventario/referencias');
			}
        });
    }



}