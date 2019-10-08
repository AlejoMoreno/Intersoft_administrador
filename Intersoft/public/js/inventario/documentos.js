var documentos = new Documentos();


function Documentos(){

    var producto_seleccionado;
    var lista_productos_seleccionados = new Array();
    var lista_tabla = new Array();

    this.initial = function(){
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
        $('#signo').val(data.signo);
        $('#ubicacion').val(data.ubicacion);
        $('#prefijo').val(data.prefijo);
        $('#num_max').val(data.num_max);
        $('#num_min').val(data.num_min);
        $('#num_presente').val(data.num_presente);
        $('#cuenta_contable_partida').val(data.cuenta_contable_partida);
        $('#cuenta_contable_contrapartida').val(data.cuenta_contable_contrapartida);
		$('input[type="submit"]').attr('disabled','disabled');
    };

    this.sendUpdate = function(){
        parametros = {
            "id" : $('#id').val(),
            "nombre" : $('#nombre').val(),
            "signo" : $('#signo').val(),
            "ubicacion" : $('#ubicacion').val(),
            "prefijo"  : $('#prefijo').val(),
            "num_max"  : $('#num_max').val(),
            "num_min"  : $('#num_min').val(),
            "num_presente"  : $('#num_presente').val(),
            "cuenta_contable_partida" : $('#cuenta_contable_partida').val(),
			"cuenta_contable_contrapartida" : $('#cuenta_contable_contrapartida').val()
        };
        $.ajax({
			data:  parametros,
			url:   '/inventario/documentos/update',
			type:  'post',
			beforeSend: function () {
				$('#resultado').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
                console.log(response);
                config.Redirect('/inventario/documentos');
			}
        });
    }


    /**DOCUMENTO**/

    this.searchDirectorio = function(e){
        var input, filter, ul, li, a, i;
        input = document.getElementById("cedula_tercero");
        filter = input.value.toUpperCase();
        ul = document.getElementById("listDirectorio");
        if(input.value != ""){
            ul.style.display = "inline";
            document.getElementById("nombre_tercero").value = " ";
        }
        else{
            ul.style.display = "none";
        }
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    this.searchDirectorio2 = function(e){
        var input, filter, ul, li, a, i;
        input = document.getElementById("nombre_tercero");
        filter = input.value.toUpperCase();
        ul = document.getElementById("listDirectorio2");
        if(input.value != ""){
            ul.style.display = "inline";
            document.getElementById("cedula_tercero").value = " ";
        }
        else{
            ul.style.display = "none";
        }
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        } 
    }

    this.seleccionDirectorio = function(obj){
        console.log("OBJETO SELECCIONADO");
        console.log(obj);
        input_cedula = document.getElementById("cedula_tercero");
        input_nombre = document.getElementById("nombre_tercero");
        ul = document.getElementById("listDirectorio");
        ul2 = document.getElementById("listDirectorio2");
        input_cedula.value = obj.nit;
        input_nombre.value = obj.razon_social;
        ul.style.display = "none";
        ul2.style.display = "none";
        document.getElementById('fecha').focus();
    }

    this.searchReferencia = function(indice,id){
        var input, filter, table, li, a, i;
        input = document.getElementById(id);
        filter = input.value.toUpperCase();
        table = document.getElementById("lista_referencias");
        tr = table.getElementsByTagName("tr");
        /*if(input.value != ""){
            table.style.display = "inline";
        }
        else{
            table.style.display = "none";
        }*/
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[indice];
            if(td){
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }
        }   
    }

    this.searchReferencia_online = function(){
        var input = document.getElementById("search_referencia");
        $("#tbody_productos").html("<thead>"+
              "<tr>"+
                "<th>Ref</th>"+
                "<th>Descripción</th>"+
                 "<th>Código Barras</th>"+
                 "<th>Costo</th>"+
                 "<th>Precio</th>"+
                 "<th>Saldo</th>"+
                 "<th>IVA</th>"+
              "</tr>"+
            "</thead>"+
            "<tbody>"+
            "</tbody>");
        var parametros = {
            'search'     : input.value.toUpperCase(),
            'token'      : 'wakusoft2019'
        };
        //console.log(parametros);
        $.ajax({
            data:  parametros,
            url:   HOST+'/inventario/referencias/search',
            type:  'post',
            beforeSend: function () {
                $('#resultado_inventario').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="http://pa1.narvii.com/6598/aa4c454ca15cbd104315d00a5590246f8b8dbbda_00.gif" style="margin-top: 20%;"></div></center>');
            },
            success:  function (response) {
                $('#resultado_inventario').hide();
                console.log(response);
                //si la respuesta es correcta 
                try{
                    var tabla = document.getElementById("tbody_productos");
                    $("#tbody_productos").html("<thead>"+
                      "<tr>"+
                        "<th>Ref</th>"+
                        "<th>Descripción</th>"+
                         "<th>Código Barras</th>"+
                         "<th>Costo</th>"+
                         "<th>Precio</th>"+
                         "<th>Saldo</th>"+
                         "<th>IVA</th>"+
                      "</tr>"+
                    "</thead>");
                    for(var i; i > response.body.length; i++){
                        console.log(i);
                        $("#tbody_productos").append("<tr>"+
                        "<td>Ref</td>"+
                        "<td>Descripción</td>"+
                         "<td>Código Barras</td>"+
                         "<td>Costo</td>"+
                         "<td>Precio</td>"+
                         "<td>Saldo</td>"+
                         "<td>IVA</td>"+
                      "</tr>");
                    }
                    $("#tbody_productos").append("<tbody>"+
                    "</tbody>");
                    
                    /*cel0.innerHTML = '<div onclick="documentos.seleccionReferencia('+response.body[0]+')" >'+response.body[0].codigo_linea+response.body[0].codigo_letras+response.body[0].codigo_consecutivo+'</div>';
                    cel1.innerHTML = '<div onclick="documentos.seleccionReferencia('+response.body[0]+')" >'+response.body[0].descripcion+'</div>';
                    cel2.innerHTML = '<div onclick="documentos.seleccionReferencia('+response.body[0]+')" >'+response.body[0].codigo_barras+'</div>';
                    cel3.innerHTML = '<div onclick="documentos.seleccionReferencia('+response.body[0]+')" >'+response.body[0].costo+'</div>';
                    cel4.innerHTML = '<div onclick="documentos.seleccionReferencia('+response.body[0]+')" >'+response.body[0].precio1+'|'+response.body[0].precio2+'|'+response.body[0].precio3+'</div>';
                    cel5.innerHTML = '<div onclick="documentos.seleccionReferencia('+response.body[0]+')" >'+response.body[0].saldo+'</div>';
                    cel6.innerHTML = '<div onclick="documentos.seleccionReferencia('+response.body[0]+')" >'+response.body[0].iva+'</div>';
                */}
                catch(e){
                    console.log("no existe producto");
                    $("#tbody_productos").html("<thead>"+
                      "<tr>"+
                        "<th>Ref</th>"+
                        "<th>Descripción</th>"+
                         "<th>Código Barras</th>"+
                         "<th>Costo</th>"+
                         "<th>Precio</th>"+
                         "<th>Saldo</th>"+
                         "<th>IVA</th>"+
                      "</tr>"+
                    "</thead>"+
                    "<tbody>"+
                    "</tbody>");
                }

            },
            error: function (request, status, error) {
                $('#resultado_inventario').hide();
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

    this.searchCodigoBarras = function(e){
        var input, filter, ul, li, a, i;
        input = document.getElementById("search_codigobarras");
        filter = input.value.toUpperCase();
        ul = document.getElementById("lista_codigobarras");
        if(input.value != ""){
            ul.style.display = "inline";
        }
        else{
            ul.style.display = "none";
        }
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        } 
    }

    this.searchDescripcion = function(e){
        var input, filter, ul, li, a, i;
        input = document.getElementById("search_descrpcion");
        filter = input.value.toUpperCase();
        ul = document.getElementById("lista_descripcion");
        if(input.value != ""){
            ul.style.display = "inline";
        }
        else{
            ul.style.display = "none";
        }
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }  

    }

    this.seleccionReferencia = function(obj){
        console.log("OBJETO SELECCIONADO");
        console.log(obj);
        document.getElementById("search_referencia").value = obj.codigo_interno;
        document.getElementById("search_codigobarras").value = obj.codigo_barras;
        document.getElementById("search_descrpcion").value = obj.descripcion;
        //temporal producto
        producto_seleccionado = obj;
        //console.log(producto_seleccionado);
        documentos.addProducto();
        //determinar el tamaño de la tabla
        var tam = lista_productos_seleccionados.length;
        document.getElementById(tam+"_cantidad").focus();
        document.getElementById(tam+"_cantidad").value = '1';
    }

    this.seleccionCodigoBarras = function(obj){
        console.log("OBJETO SELECCIONADO");
        console.log(obj);
        document.getElementById("search_referencia").value = obj.codigo_interno;
        document.getElementById("search_codigobarras").value = obj.codigo_barras;
        document.getElementById("search_descrpcion").value = obj.descripcion;
        document.getElementById("lista_referencias").style.display = "none";
        document.getElementById("lista_descripcion").style.display = "none";
        document.getElementById("lista_codigobarras").style.display = "none";
        //temporal producto
        producto_seleccionado = obj;
        //console.log(producto_seleccionado);
        documentos.addProducto();
        //determinar el tamaño de la tabla
        var tam = lista_productos_seleccionados.length;
        document.getElementById(tam+"_cantidad").focus();
        document.getElementById(tam+"_cantidad").value = '1';
    }

    this.seleccionDescripcion = function(obj){
        console.log("OBJETO SELECCIONADO");
        console.log(obj);
        document.getElementById("search_referencia").value = obj.codigo_interno;
        document.getElementById("search_codigobarras").value = obj.codigo_barras;
        document.getElementById("search_descrpcion").value = obj.descripcion;
        document.getElementById("lista_referencias").style.display = "none";
        document.getElementById("lista_descripcion").style.display = "none";
        document.getElementById("lista_codigobarras").style.display = "none";
        //temporal producto
        producto_seleccionado = obj;
        //console.log(producto_seleccionado);
        documentos.addProducto();
        //determinar el tamaño de la tabla
        var tam = lista_productos_seleccionados.length;
        document.getElementById(tam+"_cantidad").focus();
        document.getElementById(tam+"_cantidad").value = '1';
    }

    this.siguiente = function(e,next){
        if(e.keyCode == 13){
            document.getElementById(next).focus();
        }
    }


    this.fechaActual = function(e){
        if(e.keyCode == 13){
            if(document.getElementById('fecha').value == ''){
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!
                var yyyy = today.getFullYear();
                document.getElementById('fecha').value = yyyy+"-"+config.zfill(mm,2)+"-"+config.zfill(dd,2);
                document.getElementById('fecha_vencimiento').focus();
            }
            else{
                document.getElementById('fecha_vencimiento').focus();
            }
        }
    }

    this.enterObser = function(e){
        if(e.keyCode == 13){
            documentos.save_documento();
        }
    }

    /***
    *   PRODUCTOS
    */

    this.addProducto = function(){
        console.log("PRODUTO EN STAF (traer)");
        if(producto_seleccionado != undefined){
             console.log(producto_seleccionado);
            //añadir producto 
            lista_productos_seleccionados.push(producto_seleccionado);
            console.log(lista_productos_seleccionados);
            documentos.mostrarProductos(producto_seleccionado);

        }
        else{
            console.log('Elija el prducto');
        }
       
    }

    this.mostrarProductos = function(producto_seleccionado){
        var tabla = document.getElementById("tabla_productos");
        var row = tabla.insertRow(tabla.rows.length);
        var cel0 = row.insertCell(0);
        var cel1 = row.insertCell(1);
        var cel2 = row.insertCell(2);
        var cel3 = row.insertCell(3);
        var cel4 = row.insertCell(4);
        var cel5 = row.insertCell(5);
        var cel6 = row.insertCell(6);
        var cel7 = row.insertCell(7);
        var cel8 = row.insertCell(8);
        var cel9 = row.insertCell(9);
        var cel10 = row.insertCell(10);

        var lotes = "";
        var serial = "";
        var fechavencimiento = "";
        var valor = "";
        var cantidad = "";
        if(document.getElementById('signoDocumento').value == '-'){
            lotes = "<select onchange='documento.cambiolote();' class='form-control' id='"+lista_productos_seleccionados.length+"_lote' >";
            for (var i = 0; i < producto_seleccionado.lotes.length; i++) {
                lotes += "<option vale='"+producto_seleccionado.lotes[i].numero_lote+"'>"
                    +producto_seleccionado.lotes[i].numero_lote+" :: "
                    +producto_seleccionado.lotes[i].serial+" :: "
                    +producto_seleccionado.lotes[i].fecha_vence_lote+"</option>";
            }
            lotes += "</select>";
            serial = "<input type='hidden' class='form-control' value='0' id='"+lista_productos_seleccionados.length+"_serial' >";
            fechavencimiento = "<input type='hidden' class='form-control' id='"+lista_productos_seleccionados.length+"_fecha_vence' >";
            valor = "<select onchange='documentos.calcular("+lista_productos_seleccionados.length+")' class='form-control' id='"+lista_productos_seleccionados.length+"_valor' >"+
                    "<option value="+producto_seleccionado.precio1+"> "+producto_seleccionado.precio1+"</option>"+
                    "<option value="+producto_seleccionado.precio2+"> "+producto_seleccionado.precio2+"</option>"+
                    "<option value="+producto_seleccionado.precio3+"> "+producto_seleccionado.precio3+"</option>"+
                    "</select>";
            cantidad = "<input type='number' onkeyup='documentos.calcular("+lista_productos_seleccionados.length+")' class='form-control' value='0' placeholder='Ej.(1)' id='"+lista_productos_seleccionados.length+"_cantidad' onchange='documentos.cantidad("+lista_productos_seleccionados.length+");'><div id='"+lista_productos_seleccionados.length+"error' class='error'></div><div id='"+lista_productos_seleccionados.length+"peligro' class='peligro'></div>";
        }
        else if(document.getElementById('signoDocumento').value == '='){
            lotes = "";
            serial = "";
            fechavencimiento = "";
            valor = "<input type='number' onkeyup='documentos.calcular("+lista_productos_seleccionados.length+")' class='form-control' value='0' id='"+lista_productos_seleccionados.length+"_valor' >";
            cantidad = "<input type='number' onkeyup='documentos.calcular("+lista_productos_seleccionados.length+")' class='form-control' value='0' placeholder='Ej.(1)' id='"+lista_productos_seleccionados.length+"_cantidad' onchange='documentos.cantidad("+lista_productos_seleccionados.length+");'><div id='"+lista_productos_seleccionados.length+"error' class='error'></div><div id='"+lista_productos_seleccionados.length+"peligro' class='peligro'></div>"; 
        }
        else{
            lotes = "<input type='text' class='form-control' value='0' placeholder='Ej.(1887628920)' id='"+lista_productos_seleccionados.length+"_lote' >";
            serial = "<input type='text' class='form-control' value='0' placeholder='Ej.(18-87-6289-20)' id='"+lista_productos_seleccionados.length+"_serial' >";
            fechavencimiento = "<input type='date' class='form-control' style='width:100px' id='"+lista_productos_seleccionados.length+"_fecha_vence' >";
            valor = "<input type='number' onkeyup='documentos.calcular("+lista_productos_seleccionados.length+")' class='form-control' value='"+producto_seleccionado.costo_promedio+"' id='"+lista_productos_seleccionados.length+"_valor' >";
            cantidad = "<input type='number' onkeyup='documentos.calcular("+lista_productos_seleccionados.length+")' class='form-control' value='0' placeholder='Ej.(1)' id='"+lista_productos_seleccionados.length+"_cantidad'>";
        }

        cel0.innerHTML = "<input type='checkbox' id='"+lista_productos_seleccionados.length+"_check' class='form-control' onchange='documentos.seleccion_renglon("+lista_productos_seleccionados.length+");' >";
        cel1.innerHTML = "<input type='hidden' id='"+lista_productos_seleccionados.length+"_producto' value='"+producto_seleccionado.id+"'>"+producto_seleccionado.codigo_interno;
        cel2.innerHTML = "<input type='hidden' id='"+lista_productos_seleccionados.length+"_saldo' value='"+producto_seleccionado.saldo+"' >"+"<input type='hidden' id='"+lista_productos_seleccionados.length+"_maxmin' value='"+producto_seleccionado.stok_minimo+"_"+producto_seleccionado.stok_maximo+"' >"+producto_seleccionado.descripcion;
        cel3.innerHTML = lotes;
        cel4.innerHTML = serial;
        cel5.innerHTML = fechavencimiento;
        cel6.innerHTML = cantidad;
        cel7.innerHTML = "<input type='number' onkeyup='documentos.calcular("+lista_productos_seleccionados.length+")' class='form-control' value='0' placeholder='Ej.(10)' id='"+lista_productos_seleccionados.length+"_descuento' >";
        cel8.innerHTML = valor;
        cel9.innerHTML = "<span id='"+lista_productos_seleccionados.length+"_iva' >"+producto_seleccionado.iva+"</span>";
        cel10.innerHTML = "<input type='number' id='"+lista_productos_seleccionados.length+"_valortotal' value='0' class='form-control' disabled>";
        //recorrer los productos para saber el costo en el pie de la pagina
        documentos.recorrer();
        documentos.cantidad(lista_productos_seleccionados.length);
    }

    this.cantidad = function(id){
        var cantidad = parseInt(document.getElementById(id+'_cantidad').value);
        var saldo = parseInt(document.getElementById(id+'_saldo').value);
        var min = (document.getElementById(id+'_maxmin').value).split('_', 2)[0];
        var max = (document.getElementById(id+'_maxmin').value).split('_', 2)[1];
        console.log(max);
        if(cantidad>saldo){
            console.log(cantidad+" sin esa cantidad");
            $('#'+id+'error').html('<div class="alert alert-danger" role="alert">'+
                          '<strong>Saldo Insuficiente!</strong> '+saldo+
                        '</div>');
            document.getElementById(id+'_cantidad').value = "0";
        }
        else{
            $('#'+id+'error').html('');
        }
        if(cantidad>parseInt(max)){
            $('#'+id+'peligro').html('<div class="alert alert-warning" role="alert">'+
                          '<strong>Stok Maximo !</strong> '+max+
                        '</div>');
            //document.getElementById(id+'_cantidad').value = "0";
        }
        else if(cantidad<parseInt(min)){
            $('#'+id+'peligro').html('<div class="alert alert-warning" role="alert">'+
                          '<strong>Stok Minimo !</strong> '+min+
                        '</div>');
            //document.getElementById(id+'_cantidad').value = "0";
        }
        else{
            $('#'+id+'peligro').html('');
        }
    }

    this.calcular = function(index){
        var cantidad, descuento, valor, total;
        cantidad = document.getElementById(index+"_cantidad").value;
        valor = document.getElementById(index+"_valor").value;
        descuento = document.getElementById(index+"_descuento").value;
        descuento = ((cantidad * valor) * descuento ) / 100 ;
        total = (cantidad * valor);
        document.getElementById(index+"_valortotal").value = total;
        documentos.recorrer();
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
        var tabla = document.getElementById("tabla_productos");
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
        var valor_iva=0;
        var valor_descuento = 0;
        var valor_flete = parseInt($('#fletes').val());
        //console.log("RECORRIDO DE PRODUCTOS ("+lista_productos_seleccionados.length+")");
        var tabla = document.getElementById("tabla_productos");
        for (var i=1;i < tabla.rows.length; i++){  
            valor_principal=parseInt($('#'+i+'_valortotal').val())+valor_principal;
            valor_iva=parseInt(
                ( parseInt($('#'+i+'_valortotal').val()) * $('#'+i+'_iva').text() )
            )+valor_iva;
            valor_descuento = (
                ( parseInt($('#'+i+'_descuento').val()) * parseInt($('#'+i+'_valortotal').val()) )
                /100)+valor_descuento;

            //console.log(valor_principal);
        }
        //console.log("SUBTOTAL");
        //console.log(totales);
        var valor_retefuente = (valor_principal * 2.5)/100;
        impoconsumo = parseInt($('#impoconsumo').val());
        otro_impuesto = parseInt($('#otro_impuesto').val());

        $('#subtotal').val(valor_principal);
        $('#iva').val(valor_iva);
        $('#descuento').val(valor_descuento);
        $('#retefuente').val(valor_retefuente);
        $('#total').val(valor_principal + valor_iva - valor_descuento + valor_flete - valor_retefuente + impoconsumo + otro_impuesto);
    }

    this.save_documento = function(){
        
        //validaciones
        if(this.verificar() == true){ //todo esta correcto
            this.saveFactura();
            $('#Guardar').hide();
            $('#imprimirPOST').show(100);
            $('#imprimirDOC').show(100);
        }
        else{
            swal({
              title: "Verifica algo anda mal",
              text: "Los campos resaltados en rojo son importantes para este formulario",
              icon: "error",
              button: "Aceptar",
            });
        }
        
        
    }

    this.verificar = function(){
        arrayVerificacion = ['subtotal','fecha','nombre_tercero','cedula_tercero','numero'];
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

    this.saveFactura = function(){
        var prefijo = '';
        var fecha_vencimiento = '';
        if($('#prefijo').val()=='')             { prefijo = '_'; }                          else { prefijo = $('#prefijo').val(); }
        if($('#fecha_vencimiento').val()=='')   { fecha_vencimiento = $('#fecha').val(); }  else { fecha_vencimiento = $('#fecha_vencimiento').val(); }
        var parametros = {
            'id_sucursal' : '1',
            'numero' : $('#numero').val(),
            'prefijo' : prefijo,
            'id_cliente' : $('#cedula_tercero').val(), //debe ser el id
            'id_tercero' : $('#cedula_tercero').val(), //debe ser el id
            'id_vendedor' : $('#id_modificado').val(),
            'fecha' : $('#fecha').val(),
            'fecha_vencimiento' : fecha_vencimiento,
            'id_documento' : $('#idDocumento').val(),
            'signo' : $('#signoDocumento').val(),
            'subtotal' :  $('#subtotal').val(),
            'iva' : $('#iva').val(),
            'impoconsumo' : $('#impoconsumo').val(),
            'otro_impuesto' : $('#otro_impuesto').val(),
            'otro_impuesto1' : '0',
            'descuento' : $('#descuento').val(),
            'fletes' : $('#fletes').val(),
            'retefuente' : $('#retefuente').val(),
            'total' : $('#total').val(),
            'id_modificado' : localStorage.getItem('Id_usuario'),
            'observaciones' : $('#observaciones').val(),
            'estado' : 'ACTIVO',
            'saldo'  : $('#total').val(),
            'tipo_pago' : $('#tipo_pago').val()
        };
        $.ajax({
            data:  parametros,
            url:   HOST+'/factura/saveDocument',
            type:  'post',
            beforeSend: function () {
                $('#resultado').html('<center><div id="cargando" style="position: absolute;width: 100%;height: 100%;background: black;top: 0px;left: 0px;opacity: 0.8;z-index:100"><img src="http://pa1.narvii.com/6598/aa4c454ca15cbd104315d00a5590246f8b8dbbda_00.gif" style="margin-top: 20%;"></div></center>');
            },
            success:  function (response) {
                console.log(response);
                $('#resultado').hide();
                //si la respuesta es correcta 
                if(response.result == "success"){
                    factura = response.body;

                    localStorage.setItem("factura",factura.id);

                    var tabla = document.getElementById("tabla_productos");
                    for (var i=1;i < tabla.rows.length; i++){  

                        var cantidad, descuento, valor, total;
                        cantidad = document.getElementById(i+"_cantidad").value;
                        valor = document.getElementById(i+"_valor").value;
                        descuento = document.getElementById(i+"_descuento").value;
                        descuento = ((cantidad * valor) * descuento ) / 100 ;
                        total = (cantidad * valor);
                        if($('#'+i+'_fecha_vence').val() == ''){
                            $('#'+i+'_fecha_vence').val('1999-12-12');
                        }
                        document.getElementById(i+"_valortotal").value = total;

                        var parametros = {
                            'id_sucursal' : '1',
                            'numero' : factura.numero,
                            'prefijo' : factura.prefijo,
                            'id_cliente' : factura.id_cliente,
                            'id_factura' : factura.id,
                            'id_vendedor' : factura.id_vendedor,
                            'fecha' : factura.fecha,
                            'id_referencia' : $('#'+i+'_producto').val(),
                            'lote' : $('#'+i+'_lote').val(),
                            'serial' : $('#'+i+'_serial').val(), //falta
                            'fecha_vencimiento' : $('#'+i+'_fecha_vence').val(), //falta
                            'cantidad': $('#'+i+'_cantidad').val(),
                            'precio' : $('#'+i+'_valor').val(),
                            'costo' : $('#'+i+'_valor').val(),
                            'id_documento' : factura.id_documento,
                            'signo' : factura.signo,
                            'subtotal' : $('#'+i+'_valortotal').val(),
                            'iva' : $('#'+i+'_iva').text(),
                            'impoconsumo': factura.impoconsumo,
                            'otro_impuesto' : factura.otro_impuesto,
                            'otro_impuesto1' : factura.otro_impuesto1,
                            'descuento' : $('#'+i+'_descuento').val(),
                            'fletes' : factura.fletes,
                            'retefuente' : factura.retefuente,
                            'total' : total,
                            'observaciones' : factura.observaciones,
                            'id_modificado' : factura.id_modificado,
                            'kardex_anterior' : factura.id,
                            'estado' : factura.estado
                        };
                        $.ajax({
                            data:  parametros,
                            url:   HOST+'/kardex/saveDocument',
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

                    swal({
                      title: "Imprimir",
                      text: "¿Deseas imprimir el documento?",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        window.location.replace("imprimir/"+factura.id);
                      } else {
                        swal("Guardado exitoso. En otra ocación podrás imprmir.");
                      }
                    });

                }
                else{
                    alert("Error interno con el servicio adquirido");
                }
                
            },
            error: function (request, status, error) {
                $('#resultado').hide();
                console.log(request.responseText);
                swal({
                  title: "Algo anda mal",
                  text: "Verifique conexión a internet y/o diligencie completamente los campos del encabezado",
                  icon: "error",
                  button: "Aceptar",
                });
            }
        });
    }


    this.eliminar = function(){

        function ordMayorAMenor(elem1, elem2) {return elem2-elem1;}

        documentos.seleccion();

        var tabla = document.getElementById("tabla_productos");
        //ordenar lista 
        lista_tabla.sort(ordMayorAMenor);
        console.log(lista_tabla);
        for (var i=0;i < lista_tabla.length; i++){  
            tabla.deleteRow(lista_tabla[i]);
        }
        if(tabla.rows.length == 1){
            lista_productos_seleccionados.splice(0, lista_productos_seleccionados.length);
        }
        console.log(lista_productos_seleccionados);
        //vaciar lista de renglones seleccionados
        lista_tabla.splice(0, lista_tabla.length);
    }
    

    this.imprimirPost = function(){
        var id_factura = localStorage.getItem("factura");
        window.location.replace("imprimirpost/"+id_factura);
    }

    this.imprimir = function(){
        var id_factura = localStorage.getItem("factura");
        window.location.replace("imprimir/"+id_factura);
    }

}
