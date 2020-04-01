@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Sucursales</h4>
                    <p class="category">Diferentes Sucursales</p><br>
                    <a href="/download/excel/sucursales"><img width="50" src="https://image.flaticon.com/icons/svg/179/179383.svg" alt="Descargar Todo" title="Descargar todo"></a>
                    <a href="/download/excel/sucursales"><img width="50" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Microsoft_Excel_2013_logo.svg/2000px-Microsoft_Excel_2013_logo.svg.png" alt="Descargar parcial xls" title="Descargar parcial xls"></a>
                    <a href="/download/pdf/sucursales"><img width="50" src="https://image.flaticon.com/icons/svg/337/337946.svg" alt="Descargar parcial pdf" title="Descargar parcial pdf"></a>
                    <div data-toggle="modal" data-target="#grafica"><img width="50" src="https://image.flaticon.com/icons/svg/2709/2709704.svg"></div>
                </div>
                <div class="content">
                    <div style="overflow-x:scroll;overflow-y:scroll;height:500px;">
                        <table class="table table-hover table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th>ID</th> 
                                    <th>Nombre</th> 
                                    <th>Código</th>
                                    <th>dirección</th>
                                    <th>encargado</th>
                                    <th>telefono</th>
                                    <th>correo</th>
                                    <th>ciudad</th> 
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sucursales as $sucursal)
                                    <tr id="row{{ $sucursal['id'] }}">
                                        <td>{{ $sucursal['id'] }}</td>
                                        <td>{{ $sucursal['nombre'] }}</td>
                                        <td>{{ $sucursal['codigo'] }}</td>
                                        <td>{{ $sucursal['direccion'] }}</td>
                                        <td>{{ $sucursal['encargado'] }}</td>
                                        <td>{{ $sucursal['telefono'] }}</td>
                                        <td>{{ $sucursal['correo'] }}</td>
                                        <td>{{ $sucursal['ciudad']['nombre'] }}</td>
                                        <td><a href="javascript:;" onclick="sucursal.update('{{ $sucursal }}');"><button class="btn btn-warning">></button></a></td>
                                        <!--td><a onclick="config.delete_get('/administrador/sucursales/delete/', '{{ $sucursal }}',  '/administrador/sucursales');" href="#"><button class="btn btn-danger">x</button></a></td-->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h4>Crear sucursales clases</h4>
                    <table class="table table-hover table-striped" id="tabledirectorio_clases">
                        <thead>
                            <tr>
                                <th>Nombre</th> 
                                <th>Código</th>
                                <th>dirección</th>
                                <th>encargado</th>
                                <th>telefono</th>
                                <th>correo</th>
                                <th>ciudad</th> 
                                <th></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form action='/administrador/sucursales/create' method="POST" name="formulario" id="formulario">
                                    <input type="hidden" name="id" id="id">
                                <td><input type="text" name="nombre" class="form-control"  onkeyup="config.UperCase('nombre');" id="nombre" placeholder="Nombre" required></td>
                                <td><input type="text" name="codigo" class="form-control"  onkeyup="config.UperCase('codigo');" id="codigo" placeholder="Código" required></td>
                                <td><input type="text" name="direccion" class="form-control"  onkeyup="config.UperCase('direccion');" id="direccion" placeholder="Dirección" required></td>
                                <td><input type="text" name="encargado" class="form-control"  onkeyup="config.UperCase('encargado');" id="encargado" placeholder="Encargado" required></td>
                                <td><input type="number" name="telefono" class="form-control"  onkeyup="config.UperCase('telefono');" id="telefono" placeholder="Teléfono" required></td>
                                <td><input type="email" name="correo" class="form-control"  onkeyup="config.UperCase('correo');" id="correo" placeholder="Correo" required></td>
                                <td><select name="ciudad" class="form-control"  onkeyup="config.UperCase('ciudad');" id="ciudad" placeholder="Ciudad" required>
                                    <option value="">SELECCIONE CIUDAD</option>
                                    @foreach( $ciudades as $ciudad )
                                    <option value="{{ $ciudad['id'] }}">{{ $ciudad['nombre'] }}</option>
                                    @endforeach
                                </select></td>
                                <td><input type="hidden" name="id_empresa" class="form-control" value="{{ $empresas['id'] }}"  onkeyup="config.UperCase('id_empresa');" id="id_empresa" placeholder="id_empresa"></td>
                                <td><input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control"></td>
                                <td><div id="actualizar" onclick="config.send_post('#formulario', '/administrador/sucursales/update', '/administrador/sucursales');" class="btn btn-warning form-control">Actualizar</div></td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                    <div id="resultado"></div>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/administrador/index');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="grafica" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Grafica de ventas y compras por sucursales</h4>
        </div>
        <div class="modal-body">
            <canvas id="canvas" height="280" width="600"></canvas>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
  
    </div>
  </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
<script>
    var url = HOST + '/administrador/sucursales/chart/pie';
    var ejeX = new Array();
    var Labels = new Array();
    var ejeY = new Array();
    $(document).ready(function(){
      $.get(url, function(response){
        response.forEach(function(data){
            ejeX.push((data.id_documento.nombre + data.id_sucursal));
            Labels.push(data.id_sucursal);
            ejeY.push(data.total);
        });
      });
      var ctx = document.getElementById("canvas").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels:ejeX,
                datasets: [{
                    label: "Total documento",
                    data: ejeY,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    });
    </script>

<script type="text/javascript">
    sucursal.initial();
</script>

@endsection()