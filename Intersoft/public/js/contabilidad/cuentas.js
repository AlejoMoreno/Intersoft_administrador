var cuentaContable = new CuentaContable();

function CuentaContable(){
	this.init = function(){
		$('#actualizar').hide();
		$('#data').hide();
	}
	//funciona unicamente con inputs
	this.buscar = function(valor){
		console.log(valor);
		if(true){
			parametros = {
	            "id" : $('#id').val(),
	            "clase" : $('#cuentaClase').val(),
				"nombreClase" : $('#nombreClase').val(),
				"grupo" : $('#cuentaGrupo').val(),
				"nombreGrupo" : $('#nombreGrupo').val(),
				"cuenta" : $('#cuentaCuenta').val(),
				"nombreCuenta" : $('#nombreCuenta').val(),
				"subcuenta" : $('#cuentaSubcuenta').val(),
				"nombreSubcuenta" : $('#nombreSubcuenta').val(),
				"auxiliar" : $('#cuentaAuxiliar').val(),
				"nombreAuxiliar" : $('#nombreAuxiliar').val(),
				"homologo" : $('#cuentaHomologo').val(),
				"homologo_1" : $('#cuentaHomologo_1').val()
	        };
	        $.ajax({
				data:  parametros,
				url:   '/contabilidad/buscarCuentas',
				type:  'post',
				beforeSend: function () {
					$('#resultado').html('<p>Espere porfavor</p>');
				},
				success:  function (response) {
	                console.log(response);
	                let data = response.body[0];
	                if(data.clase != "0"){
	                	$('#cuentaClase').val(data.clase);
						$('#nombreClase').val(data.nombreClase);
	                }
	                if(data.grupo != "0"){
	                	$('#cuentaGrupo').val(data.grupo);
						$('#nombreGrupo').val(data.nombreGrupo);
	                }
	                if(data.cuenta != "0"){
	                	$('#cuentaCuenta').val(data.cuenta);
						$('#nombreCuenta').val(data.nombreCuenta);
	                }
	                if(data.subcuenta != "0"){
	                	$('#cuentaSubcuenta').val(data.subcuenta);
						$('#nombreSubcuenta').val(data.nombreSubcuenta);
	                }
	                if(data.auxiliar != "0"){
						$('#cuentaAuxiliar').val(data.auxiliar);
						$('#nombreAuxiliar').val(data.nombreAuxiliar);
	                }	
	            	
					$('#id').val(data.id);
				}
	        });
		}
	};

	this.validar = function(){
		if($('#cuentaClase').val() == "0"){
			return 0;
		}
		else if($('#cuentaGrupo').val() == "0"){
			return 0;
		}
		else if($('#cuentaCuenta').val() == "0"){
			return 0;
		}
		else if($('#cuentaSubcuenta').val() == "0"){
			return 0;
		}
		else if($('#nombreSubcuenta').val() == "0"){
			return 0;
		}
		else if($('#cuentaAuxiliar').val() == "0"){
			return 0;
		}
		else{
			return 1;
		}
	}

	this.update = function( data ){
        $('#actualizar').show();
        console.log('Daatos Sucurusal-update:');
        var data = JSON.parse(data);
        console.log(data);
        //ubicar informacion en el formulario
		$('#na').val(data.na);
		$('#exogena').val(data.exogena);
		$('#descripcion').val(data.descripcion);
		$('#codigo').val(data.codigo);
		$('#pucsubcuentas').val(data.id_pucsubcuentas);
		$('#clase').val(data.clase);
		$('#naturaleza').val(data.naturaleza);
		$('#tipo').val(data.tipo);
        $('#id').val(data.id);
		$('#btnguardar').attr('disabled','disabled');
    };

    this.sendUpdate = function(){
        parametros = {
            "id" : $('#id').val(),
            "na" : $('#na').val(),
			"exogena" : $('#exogena').val(),
			"descripcion" : $('#descripcion').val(),
			"codigo" : $('#codigo').val(),
			"pucsubcuentas" : $('#pucsubcuentas').val(),
			"clase" : $('#clase').val(),
			"naturaleza" : $('#naturaleza').val(),
			"tipo" : $('#tipo').val()
        };
        $.ajax({
			data:  parametros,
			url:   '/contabilidad/cuentas/update',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
                console.log(response);
                config.Redirect('/contabilidad/cuentas');
			}
        });
    };

    this.buscarPUC = function(valor){
    	if(valor.substr(0,1) == ""){
    		$('#cuentaClase').val("0");
    		$('#nombreClase').val("NA");
    	}
    	else{
    		$('#cuentaClase').val(valor.substr(0,1));
    	}
    	if(valor.substr(1,1) == ""){
    		$('#cuentaGrupo').val("0");
    		$('#nombreGrupo').val("NA");
    	}
    	else{
    		$('#cuentaGrupo').val(valor.substr(1,1));
    	}
    	if(valor.substr(2,2) == ""){
    		$('#cuentaCuenta').val("0");
    		$('#nombreCuenta').val("NA");
    	}
    	else{
    		$('#cuentaCuenta').val(valor.substr(2,2));
    	}
		if(valor.substr(4,2)== ""){
    		$('#cuentaSubcuenta').val("0");
    		$('#nombreSubcuenta').val("NA");
    	}
    	else{
    		$('#cuentaSubcuenta').val(valor.substr(4,2));
    	}
		if(valor.substr(6,2)== ""){
    		$('#cuentaAuxiliar').val("0");
    		$('#nombreAuxiliar').val("NA");
    	}
    	else{
    		$('#cuentaAuxiliar').val(valor.substr(6,2));
    	}
		cuentaContable.buscar($('#cuentaAuxiliar').val());
	}
	
	this.changeSubCuentas = function(){
		var pucsubcuentas = $('#pucsubcuentas').val();
		var lista = '<datalist id="pucauxiliarcuentas" >';
		var obj = JSON.parse($('#data').text());
		obj.forEach(element => {
			if(element['id_pucsubcuentas']==pucsubcuentas){
				lista += "<option value='"+element['codigo']+"'>"+element['codigo']+"-"+element['descripcion']+"</option>";
			}
		});
		lista += '</datalist>';
		$('#listachange').html(lista);
	}

	this.changeAuxiliarCuentas = function(){
		var textpucauxiliarcuentas = $('#codigo').val();
		var obj = JSON.parse($('#data').text());
		var flag = false;
		obj.forEach(element => {
			if(element['codigo']==textpucauxiliarcuentas){
				$('#descripcion').val(element['descripcion']);
				flag = true;
			}
		});
		if(!flag==true){$('#descripcion').val("");}
	}

}