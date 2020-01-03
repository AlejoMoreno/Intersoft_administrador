@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Documentos Contables</h4>
                </div>
                <div class="content">
                    <table class="table table-hover table-striped" id="tableregimenes">
                        <thead>
                            <tr>
                                <th>Tipo Documento</th>
                                <th>Sucursal</th>
                                <th>Numero Documento</th>
                                <th>Fecha documento</th>
                                <th>Entrar al comprobante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach( $data as $dat){
                            ?>
                            <tr>
                                <td><?php echo $nombre_tipo_documento ?></td>
                                <td><?php echo $dat['id_sucursal'] ?></td>
                                <td><?php echo $dat['numero_documento'] ?></td>
                                <td><?php echo $dat['fecha_documento'] ?></td>
                                <td><div class="btn btn-success" onclick="obj.viewComprobantes(<?php echo $dat['numero_documento']; ?>)">Entrar</div></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <table class="table table-hover table-striped" id="tableregimenes">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th># doc</th>
                                    <th>auxiliar</th>
                                    <th>Debito</th>
                                    <th>Credito</th>
                                    <th>tercero</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="cuerpo">
                            </tbody>
                        </table>
                        <h4>Adicionar Movimiento Contable</h4>
                        <table class="table table-hover table-striped" > 
                           
                            <tbody>
                                    <tr>
                                        <td> <input placeholder="tipo_documento" class="form-control" id="tipo_documento"></td>
                                        <td> <input placeholder="id_sucursal" class="form-control" id="id_sucursal"></td>
                                        <td> <input placeholder="id_documento" class="form-control" id=id_documento_text"></td>
                                        <td> <input placeholder="numero_documento" class="form-control" id=numero_documento"></td>
                                        <td> <input placeholder="prefijo" class="form-control" id=prefijo"></td>
                                        <td> <input placeholder="fecha_documento" class="form-control" id=fecha_documento"></td>
                                                                               
                                    </tr>
                                    <tr>
                                        <td> <input placeholder="valor_transaccion" class="form-control" id=valor_transaccion"></td>
                                        <td> <input placeholder="tipo_transaccion" class="form-control" id=tipo_transaccion"></td>
                                        <td> <input placeholder="tercero" class="form-control" id=tercero"></td> 
                                        <td><div class="btn btn-success" onclick="obj.createComprobantes()">Adicionar Movimiento</div></td>
                                    </tr>
                                </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
    </div>
</div>
<script type="text/javascript">
var obj = new Obj();
obj.initial();
function Obj(){
    this.initial = function(){
        $('.formulario_').hide();
    };
    this.value = function(input){
        if(config.getClave() == input.value){
             console.log('correcto');
             $('.formulario_').show();
        }
    };

    this.createComprobantes = function(){
        parametros = {
            'tipo_documento':$('#tipo_documento').val(),
            'id_sucursal':$('#id_sucursal').val(),
            'id_documento':$('#id_documento').val(),
            'numero_documento':$('#numero_documento').val(),
            'prefijo':$('#prefijo').val(),
            'fecha_documento':$('#fecha_documento').val(),
            'valor_transaccion':$('#valor_transaccion').val(),
            'tipo_transaccion':$('#tipo_transaccion').val(),
            'tercero':$('#tercero').val()
        };
        $.ajax({
            data:  parametros,
            url:   '/contabilidad/comprobantes/createComprobantes',
            type:  'post',
            beforeSend: function () {
                $('#resultado').css("display","inline");
            },
            success:  function (response) {
                $('#resultado').css("display","none");
                $("#cuerpo").html("");
                for(var i=0; i<response.contabilidades.length; i++){
                    var id = response.contabilidades[i].id;
                    var tr = `<tr>
                    <td>`+response.contabilidades[i].id+`</td>
                    <td>`+response.contabilidades[i].numero_documento+` `+response.contabilidades[i].prefijo+`</td>
                    <td><input class='form-control' id='id_auxiliar`+id+`' value='`+response.contabilidades[i].id_auxiliar+`'></td>`;
                    if(response.contabilidades[i].tipo_transaccion == 'D'){
                        tr = tr + `
                        <td><input class='form-control' id='Dvalor_transaccion`+id+`' value='`+response.contabilidades[i].valor_transaccion+`'></td>
                        <td><input class='form-control' id='Cvalor_transaccion`+id+`' value='0'></td>
                        `;
                    }
                    else{
                        tr = tr + `
                        <td><input class='form-control' id='Dvalor_transaccion`+id+`' value='0'></td>
                        <td><input class='form-control' id='Cvalor_transaccion`+id+`' value='`+response.contabilidades[i].valor_transaccion+`'></td>
                        `;
                    }
                    
                    tr = tr + `
                    <td><input class='form-control' id='tercero`+id+`' value='`+response.contabilidades[i].tercero+`'></td>
                    <td><div class='btn btn-warning' onclick='obj.updateComprobantes(`+id+`)'>></div>
                        <div class='btn btn-danger' onclick='obj.deleteComprobantes(`+id+`, `+response.contabilidades[i].numero_documento+`)'>x</div>
                    </td>
                    </tr>`;
                    $("#cuerpo").append(tr)
                }
            }
        });
    }

    this.viewComprobantes = function( numero_documento ){
        parametros = {
            "numero_documento" : numero_documento
        };
        $.ajax({
            data:  parametros,
            url:   '/contabilidad/comprobantes/viewComprobantes',
            type:  'post',
            beforeSend: function () {
                $('#resultado').css("display","inline");
            },
            success:  function (response) {
                console.log(response);
                $('#resultado').css("display","none");
                
                obj.recargarBody(response);
            }
        });
    }

    this.recargarBody = function (response){
        $('#tipo_documento').val(response.contabilidades[0].tipo_documento);
        $('#tercero').val(response.contabilidades[0].tercero);
        $('#id_sucursal').val(response.contabilidades[0].id_sucursal);
        $('#id_documento_text').val(response.contabilidades[0].id_documento);
        $('#numero_documento').val(response.contabilidades[0].numero_documento);
        $('#prefijo').val(response.contabilidades[0].prefijo);
        $('#fecha_documento').val(response.contabilidades[0].fecha_documento);
        
        
        $("#cuerpo").html("");
        for(var i=0; i<response.contabilidades.length; i++){
            var id = response.contabilidades[i].id;
            var tr = `<tr>
            <td>`+response.contabilidades[i].id+`</td>
            <td>`+response.contabilidades[i].numero_documento+` `+response.contabilidades[i].prefijo+`</td>
            <td><input class='form-control' id='id_auxiliar`+id+`' value='`+response.contabilidades[i].id_auxiliar+`'></td>`;
            if(response.contabilidades[i].tipo_transaccion == 'D'){
                tr = tr + `
                <td><input class='form-control' id='Dvalor_transaccion`+id+`' value='`+response.contabilidades[i].valor_transaccion+`'></td>
                <td><input class='form-control' id='Cvalor_transaccion`+id+`' value='0'></td>
                `;
            }
            else{
                tr = tr + `
                <td><input class='form-control' id='Dvalor_transaccion`+id+`' value='0'></td>
                <td><input class='form-control' id='Cvalor_transaccion`+id+`' value='`+response.contabilidades[i].valor_transaccion+`'></td>
                `;
            }
            
            tr = tr + `
            <td><input class='form-control' id='tercero`+id+`' value='`+response.contabilidades[i].tercero+`'></td>
            <td><div class='btn btn-warning' onclick='obj.updateComprobantes(`+id+`)'>></div>
                <div class='btn btn-danger' onclick='obj.deleteComprobantes(`+id+`, `+response.contabilidades[i].numero_documento+`)'>x</div>
            </td>
            </tr>`;
            $("#cuerpo").append(tr)
        }
    }

    this.deleteComprobantes = function( id, numero_documento ){
        parametros = {
            "id" : id,
            "numero_documento" : numero_documento
        };
        $.ajax({
            data:  parametros,
            url:   '/contabilidad/comprobantes/deleteComprobantes',
            type:  'post',
            beforeSend: function () {
                $('#resultado').css("display","inline");
            },
            success:  function (response) {
                console.log(response);
                $('#resultado').css("display","none");
                $("#cuerpo").html("");
                if(response.respuesta == "Ok"){
                    obj.recargarBody(response);
                }
                else{
                    alert("error en proceso");
                }
            }
        });
    }

    this.updateComprobantes = function( id, numero_documento ){
        if($('#Dvalor_transaccion'+id).val() != "0"){
            tipo_transaccion = "D";
            valor_transaccion = $('#Dvalor_transaccion'+id).val();
        }
        else{
            tipo_transaccion = "C";
            valor_transaccion = $('#Cvalor_transaccion'+id).val();
        }
        parametros = {
            "id" : id,
            "numero_documento" : numero_documento,
            "id_auxiliar" : $('#id_auxiliar'+id).val(),
            "tipo_transaccion" : tipo_transaccion,
            "valor_transaccion" :  valor_transaccion,
            "tercero" : $('#tercero'+id).val()
        };
        $.ajax({
            data:  parametros,
            url:   '/contabilidad/comprobantes/updateComprobantes',
            type:  'post',
            beforeSend: function () {
                $('#resultado').css("display","inline");
            },
            success:  function (response) {
                console.log(response);
                $('#resultado').css("display","none");
                $("#cuerpo").html("");
                if(response.respuesta == "Ok"){
                    obj.recargarBody(response);
                }
                else{
                    alert("error en proceso");
                }
            }
        });
    }
}
</script>

@endsection()