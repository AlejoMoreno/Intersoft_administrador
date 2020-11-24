var referencias = new Referencias();

function Referencias(){

    this.initial = function(parametros){
		console.log(parametros);
		$('#orden').val(parametros.orden);
		$('#tipo_reporte').val(parametros.tipo_reporte);
		$('#linea').val(parametros.linea);

        $('#actualizar').hide();
        $('#crear').hide();
        $('#tabla').show();
        $('#tabla').addClass('fadeIn');
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
        $('#row'+data.refid).css('opacity','0.4');
        //ubicar informacion en el formulario
        $('#id').val(data.refid);
        $('#codigo_linea').val(data.idlineas);
		$('#codigo_letras').val(data.refcodigo_letras);
		$('#codigo_consecutivo').val(data.refcodigo_consecutivo);
		$('#descripcion').val(data.refdescripcion);
		$('#codigo_barras').val(data.refcodigo_barras);
		$('#codigo_interno').val(data.refcodigo_interno);
		$('#codigo_alterno').val(data.refcodigo_alterno);
		$('#id_presentacion').val(data.idtipopresentaciones);
		$('#id_marca').val(data.idmarcas);
		$('#factor_rendimiento').val(data.reffactor_rendimiento);
		$('#stok_minimo').val(data.refstok_minimo);
		$('#stok_maximo').val(data.refstok_maximo);
		$('#iva').val(data.refiva);
		$('#impo_consumo').val(data.refimpo_consumo);
		$('#sobre_tasa').val(data.refsobre_tasa);
		$('#serie').val(data.refserie);
		$('#descuento').val(data.refdescuento);
		$('#id_clasificacion').val(data.idclasificaciones);
		$('#peso').val(data.refpeso);
		$('#precio1').val(data.refprecio1);
		$('#precio2').val(data.refprecio2);
		$('#precio3').val(data.refprecio3);
		$('#precio4').val(data.refprecio4);
		$('#estado').val(data.estado);
		$('#hommologo').val(data.refhommologo);
		$('#costo').val(data.refcosto);
		$('#costo_promedio').val(data.refcosto_promedio);
		$('#saldo').val(data.refsaldo);
		$('#usuario_creador').val(data.refusuarios);
		$('input[type="submit"]').hide();
		
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
	
	this.observar = function(){
		var orden = $('#orden').val();
		var tipo_reporte = $('#tipo_reporte').val();
		var linea = $('#linea').val();
        config.Redirect("referencias?orden="+orden+"&tipo_reporte="+tipo_reporte+"&linea="+linea);
	}
	
	this.envioExcel = function(){
		var orden = $('#orden').val();
		var tipo_reporte = $('#tipo_reporte').val();
		var linea = $('#linea').val();
        config.Redirect("/excel/excelreferencias1?orden="+orden+"&tipo_reporte="+tipo_reporte+"&linea="+linea);
	}

	this.envioPDF = function(){
		var orden = $('#orden').val();
		var tipo_reporte = $('#tipo_reporte').val();
		var linea = $('#linea').val();
        config.Redirect("/pdf/pdfreferencias1?orden="+orden+"&tipo_reporte="+tipo_reporte+"&linea="+linea);
	}

	this.envioPDFlistaprecios = function(numero){
		var orden = $('#orden').val();
		var tipo_reporte = $('#tipo_reporte').val();
		var linea = $('#linea').val();
        config.Redirect("/inventario/catalogo/precio/"+numero+"?orden="+orden+"&tipo_reporte="+tipo_reporte+"&linea="+linea);
	}

	this.actualizarPrecios = function (){
		
	}

}