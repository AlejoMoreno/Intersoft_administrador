@extends('layout')

@section('content')


<script src="/js/vkbeautify.js"></script>

<style>
.title{
    margin-left: 2%;
    font-weight: bold;
    font-family: Poppins;
}
.top-5-w{
    margin-top:5%;
}
.table > thead th {
    -webkit-animation: pantallain 100s infinite; /* Safari 4.0 - 8.0 */
    -webkit-animation-direction: alternate; /* Safari 4.0 - 8.0 */
    animation: pantallain 100s infinite;
    animation-direction: alternate;
}
.red{
    background: #ff4a55;
    color: white;
}
</style>

<div class="enc-article">
    <h4 class="title">Facturatech</h4>
</div>

<div class="row top-5-w">
    <p style="font-size:10pt;font-family:Poppins;margin-left:2%">Envíe las facturas a la DIAN por medio del servicio de Facturatech</p>
    <div style="margin-left: 5%;">
        <form method="GET" class="row">
            <div class="col-md-2">
                <input type="text" name="nit" placeholder="Nit" value="{{ isset($_GET['nit'])?$_GET['nit']:'' }}" class="form-control">
            </div>
            <div class="col-md-4">
                <div class="col-md-12 row">
                    <div class="col-md-8">
                        <input type="text" name="razonsocial" value="{{ isset($_GET['razonsocial'])?$_GET['razonsocial']:'' }}" placeholder="Razón social" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="vendedor" id="vendedor"> 
                            <option value="">Vendedor</option>
                            @foreach ($usuarios as $obj)
                            <option value="{{ $obj['id'] }}">{{ $obj['nombre'] }} {{ $obj['apellido'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 row">
                <div class="col-md-6">
                    <input type="date" name="fechainicio" value="{{ isset($_GET['fechainicio'])?$_GET['fechainicio']:date('Y-m-d') }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <input type="date" name="fechafinal" value="{{ isset($_GET['fechafinal'])?$_GET['fechafinal']:date('Y-m-d') }}" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <input type="submit" value="Consultar" class="btn btn-success">
            </div>
        </form><br><br>
    </div>
    <div class="col-md-11" style="overflow-x:scroll;margin-left:2%">
        <table class="table table-hover table-striped"  id="datos">
            <thead>
                <th></th>
                <th></th>
                <th>Sucursal</th>
                <th>#</th>
                <th>Nit</th>
                <th>Nombre</th>
                <th>Fecha Emisión</th>
                <th>Fecha Vencimiento</th>
                <th>total</th>
                <th>Estado</th>
                <th>Vendedor</th>
                <th>Fecha creado</th>
            </tr></thead>
            <tbody>
                @foreach($factura as $obj)
                <tr>
                    <td><div onclick="facturatech.xml('{{ $obj }}')"  class="btn btn-warning"><i style="font-size: 12px;" class="fas fa-file-alt"></i></div></td>
                    <td><div onclick="facturatech.send('{{ $obj }}')" class="btn btn-danger"><i style="font-size: 12px;" class="fas fa-file-import"></i></div></td>
                    <td><div style="width: 150px;">{{ $obj['sucunombre'] }}</div></td>
                    <td><a href="javascript:envioUrl('/documentos/imprimir/{{ $obj['idfactura'] }}')" >{{ $obj['numero'] }}</a></td>
                    <td>{{ $obj['id_tercero'] }}</td>
                    <td><div style="width: 200px;">{{ $obj['nombrecliente'] }}</div></td>
                    <td>{{ $obj['fecha'] }}</td>
                    <td>{{ $obj['fecha_vencimiento'] }}</td>
                    <td>{{ number_format($obj['total']) }}</td>
                    <td>{{ $obj['estadofactura'] }}</td>
                    <td>{{ $obj['nombrevendedor'] }} {{ $obj['apellido'] }}</td>
                    <td><div style="width: 150px;">{{ $obj['creado'] }}</div></td>
                </tr>
                @endforeach                                
            </tbody>
        </table>
        
    </div>
    
</div>




<script>
$(document).ready( function () {
    $('#datos').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ] 
    });
} );

var facturatech = new Facturatech();

facturatech.init();

function Facturatech(){
    this.init = function(){
        $('#btn_modal').hide();
    }

    this.xml = function(obj){
        factura  = JSON.parse(obj);
        //console.log(factura);
        //enviar id al servicio xml 
        var URL = "/facturacion/facturatech/"+factura.idfactura+"/xml";
        var parametros = {
            "id" : factura.idfactura,
        };
        $.ajax({
			data:  parametros,
			url:   URL,
			type:  'get',
			beforeSend: function () {
				$('#resultado').html('<p>Espere porfavor</p>');
			},
			success:  function (response) {
                console.log(response);
                var sXML = new XMLSerializer().serializeToString(response); 
                sXML = vkbeautify(sXML, 'xml');
                document.getElementById("DivXml").innerText = sXML;
                $('#btn_modal').trigger('click');

                function download(filename, text) {
                    var element = document.createElement('a');
                    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
                    element.setAttribute('download', filename);
                    element.style.display = 'none';
                    document.body.appendChild(element);
                    element.click();
                    document.body.removeChild(element);
                }
                download('Factura.xml', sXML);
			}
        });
    }
}
</script>

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" id="btn_modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">XML Generado</h4>
      </div>
      <div class="modal-body" style="overflow-y: scroll; height: 300px;">
        <p>Este es el resultado del XML</p>
        <pre>
            <code>
                <div id="DivXml"></div>
            </code>
        </pre>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection()

