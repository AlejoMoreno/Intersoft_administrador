var carteras = new Carteras();

function Carteras(){

	var lista_seleccionados = new Array();
	var lista_tabla = new Array();

    var lista_seleccionados_frp = new Array();
    var lista_tabla_frp = new Array();

	this.init = function(){

	}

	this.allDocumentos = function(){
		parametros = {
            "tipo" : "egreso"
        };
        $.ajax({
        	data:  parametros,
			url:   '/cartera/allDocumentos/' + $('#cedula_tercero').val(),
			type:  'get',
			beforeSend: function () {
				$('#tabla_facturas').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
				//console.log(response);
				$('#tabla_facturas').html('');
                console.log(response.body);
                $('#tabla_facturas').append('<table class="table table-hover table-striped" id="tabla_fac" >'+
		              '<thead>'+
		                  '<tr>'+
		                  	'<th># ID</th>'+
		                    '<th>Prefijo</th>'+
		                    '<th>Factura</th>'+
		                    '<th>Fecha</th>'+
		                    '<th>Fecha Venc</th>'+
		                    '<th>Valor</th>'+
		                    '<th>Saldo</th>'+
		                    '<th></th>'+
		                  '</tr>'+
		              '</thead><tbody>');
                $.each( response.body, function( key, value ) {
                	var id = value.id;
                	var prefijo = value.prefijo;
                	var numero = value.numero;
                	var fecha = value.fecha;
                	var fecha_vencimiento = value.fecha_vencimiento;
                	var total = value.total;
                	var saldo = value.saldo;
					$('#tabla_fac').append('<tr >'+
						'<td>'+value.id+'</td>'+
						'<td>'+value.prefijo+'</td>'+
						'<td>'+value.numero+'</td>'+
						'<td>'+value.fecha+'</td>'+
						'<td>'+value.fecha_vencimiento+'</td>'+
						'<td>'+value.total+'</td>'+
						'<td>'+value.saldo+'</td>'+
						'<td><div class="btn btn-success" id="pagarbtn" onclick="carteras.getDocumento('+
							id+',`'+
							prefijo+'`,`'+
							numero+'`,`'+
							fecha+'`,`'+
							fecha_vencimiento+'`,`'+
							total+'`,`'+
							saldo+'`'+
						')" >Pagar</div></td>'+
	                  '</tr>');
				});
				$('#tabla_fac').append('</tbody></table>');
			},
			error: function(error){
				$('#tabla_facturas').html('No existen resultados');
			}
        });
	}

    this.allDocumentos_ingreso = function(){
        parametros = {
            "tipo" : "ingreso"
        };
        $.ajax({
            data:  parametros,
            url:   '/cartera/allDocumentos/' + $('#cedula_tercero').val() + '/',
            type:  'get',
            beforeSend: function () {
                $('#tabla_facturas').html('<p>Espere porfavor</p>');
            },
            success:  function (response) {
                //console.log(response);
                $('#tabla_facturas').html('');
                console.log(response.body);
                $('#tabla_facturas').append('<table class="table table-hover table-striped" id="tabla_fac" >'+
                      '<thead>'+
                          '<tr>'+
                            '<th># ID</th>'+
                            '<th>Prefijo</th>'+
                            '<th>Factura</th>'+
                            '<th>Fecha</th>'+
                            '<th>Fecha Venc</th>'+
                            '<th>Valor</th>'+
                            '<th>Saldo</th>'+
                            '<th></th>'+
                          '</tr>'+
                      '</thead><tbody>');
                $.each( response.body, function( key, value ) {
                    var id = value.id;
                    var prefijo = value.prefijo;
                    var numero = value.numero;
                    var fecha = value.fecha;
                    var fecha_vencimiento = value.fecha_vencimiento;
                    var total = value.total;
                    var saldo = value.saldo;
                    $('#tabla_fac').append('<tr >'+
                        '<td>'+value.id+'</td>'+
                        '<td>'+value.prefijo+'</td>'+
                        '<td>'+value.numero+'</td>'+
                        '<td>'+value.fecha+'</td>'+
                        '<td>'+value.fecha_vencimiento+'</td>'+
                        '<td>'+value.total+'</td>'+
                        '<td>'+value.saldo+'</td>'+
                        '<td><div class="btn btn-success" id="pagarbtn" onclick="carteras.getDocumento('+
                            id+',`'+
                            prefijo+'`,`'+
                            numero+'`,`'+
                            fecha+'`,`'+
                            fecha_vencimiento+'`,`'+
                            total+'`,`'+
                            saldo+'`'+
                        ')" >Pagar</div></td>'+
                      '</tr>');
                });
                $('#tabla_fac').append('</tbody></table>');
            },
            error: function(error){
                $('#tabla_facturas').html('No existen resultados');
            }
        });
    }

	this.getDocumento = function(id,prefijo,numero,fecha,fecha_vencimiento,total,saldo){
		//console.log(id);
        id_factura = id;
		lista_seleccionados.push(id);
		var tabla = document.getElementById("tabla_facturas_seleccionadas");
        var row = tabla.insertRow(tabla.rows.length);
        var cel0 = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);
        var cel6 = row.insertCell(5);
        var cel7 = row.insertCell(6);
        var cel8 = row.insertCell(7);
        var cel9 = row.insertCell(8);
        var cel10 = row.insertCell(9);
        var cel11 = row.insertCell(10);
        var cel12 = row.insertCell(11);
        var cel13 = row.insertCell(12);


        cel0.innerHTML = "<input type='hidden' value='"+id+"' id='"+lista_seleccionados.length+"_id_factura'>" + 
        	"<input type='checkbox' id='"+lista_seleccionados.length+"_check' class='form-control' onchange='carteras.seleccion_renglon("+lista_seleccionados.length+");' >";
        cel2.innerHTML = "<input type='hidden' id='"+lista_seleccionados.length+"_prefijo' value='"+prefijo+"'>"+prefijo;
        cel3.innerHTML = "<input type='hidden' id='"+lista_seleccionados.length+"_numero' value='"+numero+"'>"+numero;
        cel4.innerHTML = "<input type='hidden' id='"+lista_seleccionados.length+"_fecha' value='"+fecha+"'>"+fecha;
        cel5.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_flete' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel6.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_retefuente' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel7.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_reteiva' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel8.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_reteica' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel9.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_interes' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel10.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_descuento' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel11.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='"+saldo+"' id='"+lista_seleccionados.length+"_efectivo' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel12.innerHTML = "<input type='hidden' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_total' disabled><span id='"+lista_seleccionados.length+"_span'>0</span>";
        cel13.innerHTML = "";
        carteras.calcular(lista_seleccionados.length);
        //desaparecer el boton pagar
        //$('#pagarbtn').hide();
	}


	this.calcular = function(index){
        var flete,retefuente,reteiva,reteica,interes,descuento,efectivo;
        flete = parseFloat(document.getElementById(index+'_flete').value);
        retefuente = parseFloat(document.getElementById(index+"_retefuente").value);
        reteiva = parseFloat(document.getElementById(index+"_reteiva").value);
        reteica = parseFloat(document.getElementById(index+"_reteica").value);
        interes = parseFloat(document.getElementById(index+"_interes").value);
        descuento = parseFloat(document.getElementById(index+"_descuento").value);
        efectivo = parseFloat(document.getElementById(index+"_efectivo").value);
        total = flete+retefuente+reteiva+reteica+interes-descuento+efectivo;
        $("#"+index+"_total").val(total);
        $("#"+index+"_span").html(new Intl.NumberFormat().format(total));
        carteras.recorrer();
    }


	this.seleccion_renglon = function(obj){
        var padre = document.getElementById(obj+'_check').parentNode.parentNode;
        if(padre.style.background == "rgb(66, 98, 211)"){
            padre.style.background = "#ffffff";
            padre.style.color = "#000000";
        }
        else{
            padre.style.background = "#4262d3";
            padre.style.color = "#ffffff";
        }
        //console.log(padre);
    }

    this.seleccion = function(){
        var tabla = document.getElementById("tabla_facturas_seleccionadas");
        console.log(tabla.rows.length);
        for (var i=1;i < tabla.rows.length; i++){  
            id = document.getElementById(tabla.rows[i].cells[0].getElementsByTagName("input")[0].id);
            console.log(id);
            if(id.checked == true){
                lista_tabla.push(i);
            }
        }
         // lista de renglones selecionados
        lista_tabla.sort();
    }

    this.recorrer = function(){
    	var valor_principal=0;
        var valor_flete = 0;
        var valor_retefuente = 0;
        var valor_reteiva = 0;
        var valor_reteica = 0;
        var valor_interes = 0;
        var valor_descuento = 0;
        var valor_efectivo = 0;
    	var tabla = document.getElementById("tabla_facturas_seleccionadas");
    	for (var i=1;i < tabla.rows.length; i++){  
            valor_principal=parseFloat($('#'+i+'_total').val())+valor_principal;
            valor_flete=parseFloat($('#'+i+'_flete').val())+valor_flete;
            valor_retefuente=parseFloat($('#'+i+'_retefuente').val())+valor_retefuente;
            valor_reteiva=parseFloat($('#'+i+'_reteiva').val())+valor_reteiva;
            valor_reteica=parseFloat($('#'+i+'_reteica').val())+valor_reteica;
            valor_interes=parseFloat($('#'+i+'_interes').val())+valor_interes;
            valor_descuento=parseFloat($('#'+i+'_descuento').val())+valor_descuento;
            valor_efectivo=parseFloat($('#'+i+'_efectivo').val())+valor_efectivo;
            //console.log(valor_principal);
        }
        document.getElementById('total').value = valor_principal;
        document.getElementById('valor_pago').value = valor_principal;
        document.getElementById('valor_flete').value = valor_flete;
        document.getElementById('valor_retefuente').value = valor_retefuente;
        document.getElementById('valor_reteiva').value = valor_reteiva;
        document.getElementById('valor_reteica').value = valor_reteica;
        document.getElementById('valor_interes').value = valor_interes;
        document.getElementById('valor_descuento').value = valor_descuento;
        document.getElementById('valor_efectivo').value = valor_efectivo;
    }


    this.eliminar = function(){

        function ordMayorAMenor(elem1, elem2) {return elem2-elem1;}

        carteras.seleccion();

        var tabla = document.getElementById("tabla_facturas_seleccionadas");
        //ordenar lista 
        lista_tabla.sort(ordMayorAMenor);
        console.log(lista_tabla);
        for (var i=0;i < lista_tabla.length; i++){  
            tabla.deleteRow(lista_tabla[i]);
        }
        if(tabla.rows.length == 1){
            lista_seleccionados.splice(0, lista_seleccionados.length);
        }
        console.log(lista_seleccionados);
        //vaciar lista de renglones seleccionados
        lista_tabla.splice(0, lista_tabla.length);
    }


    this.getReferenciaPago = function(){
    	var forma_pago = document.getElementById("forma_pago").value; 
		var valor_pago = document.getElementById("valor_pago").value; 
		var observacion_pago = document.getElementById("observacion_pago").value; 

		var tabla = document.getElementById("tabla_forma_pago");
        lista_seleccionados_frp.push(tabla.rows.length);
        var row = tabla.insertRow(tabla.rows.length);
        var cel0 = row.insertCell(0);
        var cel1 = row.insertCell(1);
        var cel2 = row.insertCell(2);
        var cel3 = row.insertCell(3);

        cel0.innerHTML = "<div id='"+lista_seleccionados_frp.length+"_forma_pago'>"+forma_pago+"</div>";
        cel1.innerHTML = "<input value='"+valor_pago+"' class='form-control' id='"+lista_seleccionados_frp.length+"_valor_pago' disabled>";
        cel2.innerHTML = "<div id='"+lista_seleccionados_frp.length+"_observacion_pago'>"+observacion_pago+"</div>";
        cel3.innerHTML = "<div class='btn btn-danger' onclick='carteras.eliminarFormaPago(this)' >Eliminar Forma Pago</div>";

        carteras.recorrerFormaPago();

    }

    this.recorrerFormaPago = function(){
        var valor_forma_pagos=0;
        var tabla = document.getElementById("tabla_forma_pago");
        for (var i=1;i < tabla.rows.length; i++){  
            valor_forma_pagos=parseFloat($('#'+i+'_valor_pago').val())+valor_forma_pagos;
            //console.log(valor_forma_pagos);
        }
        document.getElementById('total_forma_pago').value = valor_forma_pagos;
    }



    this.save_documento = function(tipo){
        if(carteras.verificar() == true){
            if( (parseInt($('#total').val()) - parseInt($('#total_forma_pago').val())) != 0 ){
                alert("El total no coincide con la forma de pago");
            }
            else{ //coincide
                carteras.guardar(tipo);
            }
        }
    }

    this.verificar = function(){
        arrayVerificacion = ['subtotal','fecha','cedula_tercero','total_forma_pago','total','numero'];
        intCont = 0;
        for (var i = arrayVerificacion.length - 1; i >= 0; i--) {
            if($('#'+arrayVerificacion[i]).val() == ""){
                intCont++;
                $('#'+arrayVerificacion[i]).css({'border-color':'red'});
                document.getElementById(arrayVerificacion[i]).focus();
            }
            else{
                $('#'+arrayVerificacion[i]).css({'border-color':'green'});
            }
        }
        return (intCont==0)?true:false;

    }

    this.guardar = function(tipo){
        var prefijo = '';
        if($('#prefijo').val()=='')             { prefijo = '_'; }                          else { prefijo = $('#prefijo').val(); }
        var parametros = {
            'reteiva' : $('#valor_reteiva').val(),
            'reteica' : $('#valor_reteica').val(),
            'efectivo' : $('#valor_efectivo').val(),
            'sobrecosto' : $('#valor_interes').val(),
            'descuento' : $('#valor_descuento').val(),
            'retefuente' : $('#valor_retefuente').val(),
            'otros' : $('#valor_flete').val(),
            'id_sucursal' : '1',
            'numero' : $('#numero').val(),
            'prefijo' : prefijo,
            'id_cliente' : $('#cedula_tercero').val(), //es el id
            'id_vendedor' : $('#id_modificado').val(),
            'fecha' : $('#fecha').val(),
            'tipoCartera' : tipo,
            'subtotal' :  $('#total_forma_pago').val(),
            'total' : $('#total').val(),
            'id_modificado' : localStorage.getItem('Id_usuario'),
            'observaciones' : $('#observaciones').val(),
            'estado' : 'ACTIVO'
        };
        $.ajax({
            data:  parametros,
            url:   HOST+'/cartera/egresos/guardar',
            type:  'post',
            beforeSend: function () {
                $('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="http://pa1.narvii.com/6598/aa4c454ca15cbd104315d00a5590246f8b8dbbda_00.gif" style="margin-top: 20%;"></div></center>');
            },
            success: function(response){
                console.log(response);
                $('#resultado').hide();
                //realizar el recorrido de la taba para poder realizar save de kardexCarteras
                //si la respuesta es correcta 
                if(response.result == "success"){
                    documento = response.body;

                    localStorage.setItem("documento",documento.id);

                    if(documento.tipoCartera == "GASTOS"){
                        var parametros = {
                            'id_cartera' : documento.id,
                            'id_factura' : null, 
                            'fechaFactura' : $('#fecha').val(),
                            'numeroFactura' : $('#prefijo').val()+"|"+$('#numero').val(),
                            'descuentos' : 0,
                            'sobrecostos' : 0,
                            'fletes' : 0,
                            'retefuente' : 0,
                            'efectivo' : 0,
                            'reteiva' : 0,
                            'reteica' : 0,
                            'total' : $('#total').val()
                        };
                        $.ajax({
                            data:  parametros,
                            url:   HOST+'/cartera/kardex/guardar',
                            type:  'post',
                            beforeSend: function () {
                                $('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="http://pa1.narvii.com/6598/aa4c454ca15cbd104315d00a5590246f8b8dbbda_00.gif" style="margin-top: 20%;"></div></center>');
                            },
                            success:  function (response) {
                                $('#resultado').hide();
                                console.log(response);
                                //si la respuesta es correcta 
                                if(response.result == "success"){
                                    console.log("Guardado exitoso fila "+i);
                                }
                                else{
                                    console.log("Error interno fila "+i);
                                    swal({
                                    title: "Algo anda mal",
                                    text: "Verifique conexión a internet y/o diligencie completamente los campos, en la fila " + i + " de los productos.",
                                    icon: "error",
                                    button: "Aceptar",
                                    });
                                }
                                
                            },
                            error: function (request, status, error) {
                                $('#resultado').hide();
                                console.log(request.responseText);
                                swal({
                                title: "Algo anda mal",
                                text: "Verifique conexión a internet y/o diligencie completamente los campos, en la fila " + i + " de los productos.",
                                icon: "error",
                                button: "Aceptar",
                                });
                            }
                        });
                    }
                    else if(documento.tipoCartera == "OTROINGRESO"){
                        var parametros = {
                            'id_cartera' : documento.id,
                            'id_factura' : null, 
                            'fechaFactura' : $('#fecha').val(),
                            'numeroFactura' : $('#prefijo').val()+"|"+$('#numero').val(),
                            'descuentos' : 0,
                            'sobrecostos' : 0,
                            'fletes' : 0,
                            'retefuente' : 0,
                            'efectivo' : 0,
                            'reteiva' : 0,
                            'reteica' : 0,
                            'total' : $('#total').val()
                        };
                        $.ajax({
                            data:  parametros,
                            url:   HOST+'/cartera/kardex/guardar',
                            type:  'post',
                            beforeSend: function () {
                                $('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="http://pa1.narvii.com/6598/aa4c454ca15cbd104315d00a5590246f8b8dbbda_00.gif" style="margin-top: 20%;"></div></center>');
                            },
                            success:  function (response) {
                                $('#resultado').hide();
                                console.log(response);
                                //si la respuesta es correcta 
                                if(response.result == "success"){
                                    console.log("Guardado exitoso fila "+i);
                                }
                                else{
                                    console.log("Error interno fila "+i);
                                    swal({
                                    title: "Algo anda mal",
                                    text: "Verifique conexión a internet y/o diligencie completamente los campos, en la fila " + i + " de los productos.",
                                    icon: "error",
                                    button: "Aceptar",
                                    });
                                }
                                
                            },
                            error: function (request, status, error) {
                                $('#resultado').hide();
                                console.log(request.responseText);
                                swal({
                                title: "Algo anda mal",
                                text: "Verifique conexión a internet y/o diligencie completamente los campos, en la fila " + i + " de los productos.",
                                icon: "error",
                                button: "Aceptar",
                                });
                            }
                        });
                    }
                    else{
                        var tabla = document.getElementById("tabla_facturas_seleccionadas");
                        for (var i=1;i < tabla.rows.length; i++){  

                            var flete, retefuente, reteiva, reteica, interes, descuento, efectivo, total;
                            var prefijo, numero, fecha, id_factura;
                            flete = document.getElementById(i+"_flete").value;
                            retefuente = document.getElementById(i+"_retefuente").value;
                            reteiva = document.getElementById(i+"_reteiva").value;
                            reteica = document.getElementById(i+"_reteica").value;
                            interes = document.getElementById(i+"_interes").value;
                            descuento = document.getElementById(i+"_descuento").value;
                            efectivo = document.getElementById(i+"_efectivo").value;
                            prefijo = document.getElementById(i+"_prefijo").value;
                            numero = document.getElementById(i+"_numero").value;
                            fecha = document.getElementById(i+"_fecha").value;
                            total = document.getElementById(i+"_total").value;
                            id_factura = document.getElementById(i+"_id_factura").value;
                            

                            var parametros = {
                                'id_cartera' : documento.id,
                                'id_factura' : id_factura, 
                                'fechaFactura' : fecha,
                                'numeroFactura' : prefijo+"|"+numero,
                                'descuentos' : descuento,
                                'sobrecostos' : interes,
                                'fletes' : flete,
                                'retefuente' : retefuente,
                                'efectivo' : efectivo,
                                'reteiva' : reteiva,
                                'reteica' : reteica,
                                'total' : total
                            };
                            $.ajax({
                                data:  parametros,
                                url:   HOST+'/cartera/kardex/guardar',
                                type:  'post',
                                beforeSend: function () {
                                    $('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="http://pa1.narvii.com/6598/aa4c454ca15cbd104315d00a5590246f8b8dbbda_00.gif" style="margin-top: 20%;"></div></center>');
                                },
                                success:  function (response) {
                                    $('#resultado').hide();
                                    console.log(response);
                                    //si la respuesta es correcta 
                                    if(response.result == "success"){
                                        console.log("Guardado exitoso fila "+i);
                                    }
                                    else{
                                        console.log("Error interno fila "+i);
                                        swal({
                                        title: "Algo anda mal",
                                        text: "Verifique conexión a internet y/o diligencie completamente los campos, en la fila " + i + " de los productos.",
                                        icon: "error",
                                        button: "Aceptar",
                                        });
                                    }
                                    
                                },
                                error: function (request, status, error) {
                                    $('#resultado').hide();
                                    console.log(request.responseText);
                                    swal({
                                    title: "Algo anda mal",
                                    text: "Verifique conexión a internet y/o diligencie completamente los campos, en la fila " + i + " de los productos.",
                                    icon: "error",
                                    button: "Aceptar",
                                    });
                                }
                            });
                        }
                    }

                    

                    swal({
                      title: "Imprimir",
                      text: "¿Deseas imprimir el documento?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        window.location.replace("imprimir/"+documento.id);
                      } else {
                        swal("Guardado exitoso. En otra ocación podrás imprmir.");
                      }
                    });

                }
                else{
                    alert("Error interno con el servicio adquirido");
                }
            },
            error: function(e){
                console.log(e);
            }

        });
    }

    this.agregar_gasto = function(){
        //console.log(id);
        id = $('#in_factura').val();
        id_factura = $('#in_factura').val();
        prefijo = $('#in_prefijo').val();
        numero = $('#in_factura').val();
        fecha = $('#in_fecha').val();
        saldo = $('#in_total').val();
        lista_seleccionados.push(id);
		var tabla = document.getElementById("tabla_facturas_seleccionadas");
        var row = tabla.insertRow(tabla.rows.length);
        var cel0 = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);
        var cel6 = row.insertCell(5);
        var cel7 = row.insertCell(6);
        var cel8 = row.insertCell(7);
        var cel9 = row.insertCell(8);
        var cel10 = row.insertCell(9);
        var cel11 = row.insertCell(10);
        var cel12 = row.insertCell(11);
        var cel13 = row.insertCell(12);


        cel0.innerHTML = "<input type='hidden' value='"+id+"' id='"+lista_seleccionados.length+"_id_factura'>" + 
        	"<input type='checkbox' id='"+lista_seleccionados.length+"_check' class='form-control' onchange='carteras.seleccion_renglon("+lista_seleccionados.length+");' >";
        cel2.innerHTML = "<input type='hidden' id='"+lista_seleccionados.length+"_prefijo' value='"+prefijo+"'>"+prefijo;
        cel3.innerHTML = "<input type='hidden' id='"+lista_seleccionados.length+"_numero' value='"+numero+"'>"+numero;
        cel4.innerHTML = "<input type='hidden' id='"+lista_seleccionados.length+"_fecha' value='"+fecha+"'>"+fecha;
        cel5.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_flete' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel6.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_retefuente' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel7.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_reteiva' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel8.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_reteica' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel9.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_interes' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel10.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_descuento' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel11.innerHTML = "<input type='number' style='width: 80px;' class='form-control' value='"+saldo+"' id='"+lista_seleccionados.length+"_efectivo' onkeyup='carteras.calcular("+lista_seleccionados.length+")'>";
        cel12.innerHTML = "<input type='text' style='width: 80px;' class='form-control' value='0' id='"+lista_seleccionados.length+"_total' disabled>";
        cel13.innerHTML = "";
        carteras.calcular(lista_seleccionados.length);
        //desaparecer el boton pagar
        //$('#pagarbtn').hide();
    }


}