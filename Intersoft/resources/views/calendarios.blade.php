@extends('layout')

@section('content')


<div class="container-fluid">
<div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Calendario</h4>
                    <p>Crear un nuevo evento</p>
                    <form action="/calendario/create" method="post">
                        <label for="titulo">Titulo Evento</label>
                        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo Evento">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Fecha inicio</label>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="dd" id="dd"  placeholder="dd" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <select name="mm" id="mm"  class="form-control" >
                                    <option value="">mm</option>
                                    <option value="Enero">Enero</option>
                                    <option value="Febrero">Febrero</option>
                                    <option value="Marzo">Marzo</option>
                                    <option value="Abril">Abril</option>
                                    <option value="Mayo">Mayo</option>
                                    <option value="Junio">Junio</option>
                                    <option value="Julio">Julio</option>
                                    <option value="Agosto">Agosto</option>
                                    <option value="Septiembre">Septiembre</option>
                                    <option value="Octubre">Octubre</option>
                                    <option value="Noviembre">Noviembre</option>
                                    <option value="Diciembre">Diciembre</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="aaaa" id="aaaa" placeholder="aaaa" class="form-control">
                            </div>
                        </div>
                        <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                        <label for="hora_inicio">Hora Inicio</label>
                        <input type="datetime" class="form-control"  name="hora_inicio" id="hora_inicio" value="0:00">
                        <label for="periodicidad">periodicidad Evento</label>
                        <select class="form-control" name="periodicidad" id="periodicidad">
                            <option value="">Periodicidad del Evento</option>
                            <option value="uno">Una Sola Vez</option>
                            <option value="diario">Diario</option>
                            <option value="semanal">Semanal</option>
                            <option value="mensual">Mensual</option>
                            <option value="ano">Año</option>
                        </select>
                        <div id="finaldate">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Fecha Final</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="ddfinal" id="ddfinal"  placeholder="dd" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <select name="mmfinal" id="mmfinal"  class="form-control" >
                                        <option value="">mm</option>
                                        <option value="Enero">Enero</option>
                                        <option value="Febrero">Febrero</option>
                                        <option value="Marzo">Marzo</option>
                                        <option value="Abril">Abril</option>
                                        <option value="Mayo">Mayo</option>
                                        <option value="Junio">Junio</option>
                                        <option value="Julio">Julio</option>
                                        <option value="Agosto">Agosto</option>
                                        <option value="Septiembre">Septiembre</option>
                                        <option value="Octubre">Octubre</option>
                                        <option value="Noviembre">Noviembre</option>
                                        <option value="Diciembre">Diciembre</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="aaaafinal" id="aaaafinal" placeholder="aaaa" class="form-control">
                                </div>
                            </div>
                            <input type="date" class="form-control" name="fecha_final" id="fecha_final">
                            <label for="hora_final">Hora Final</label>
                            <input type="datetime" class="form-control"  name="hora_final" id="hora_final" value="0:00">
                        </div>
                        <hr><p>Descripción Evento</p>
                        <label for="lugar">Lugar Evento</label>
                        <input type="text" class="form-control" name="lugar" id="lugar" placeholder="Lugar Evento">
                        <label for="descripcion">Descripcion</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion Evento">
                        <label for="color">Color</label>
                        <input type="color" name="color" id="color" class="form-control">
                        <hr><p>Valor de evento</p>
                        <label for="valor">Valor</label>
                        <input type="number" name="valor" id="valor" class="form-control" placeholder="Valor">
                        <br><label for="notificacion">Notificacion</label>
                        <input type="checkbox" name="notificacion" id="notificacion"><br><br>
                        <input type="submit" value="Guardar" class="btn btn-succes" >
                    </form>
                </div>
                <div class="content">


                
                    

                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i> 
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> Ir a la sección del manual
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Eventos próximos</h4>
                    <p class="category">Diferentes eventos creados</p>
                </div>
                <div class="content">
                    <div style="overflow-x:scroll;">
                    <table class="table table-hover table-striped" id="tabledepartamentos">
                        <thead>
                            <tr>
                                <th>ID</th> 
                                <th>titulo</th>
                                <th>fecha_inicio</th>
                                <th>hora_inicio</th>
                                <th>fecha_final</th>
                                <th>hora_final</th>
                                <th>lugar</th>
                                <th>descripcion</th>
                                <th>notificacion</th>
                                <th>valor</th>
                                <th>periodicidad</th>
                                <th></th> 
                                <th></th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calendarios as $calendario)
                                <tr style="background:{{ $calendario['color'] }};opacity:0.9;color:white;">
                                    <td>{{ $calendario['id'] }}</td>
                                    <td>{{ $calendario['titulo'] }}</td>
                                    <td>{{ $calendario['fecha_inicio'] }}</td>
                                    <td>{{ $calendario['hora_inicio'] }}</td>
                                    <td>{{ $calendario['fecha_final'] }}</td>
                                    <td>{{ $calendario['hora_final'] }}</td>
                                    <td>{{ $calendario['lugar'] }}</td>
                                    <td>{{ $calendario['descripcion'] }}</td>
                                    <td>{{ $calendario['notificacion'] }}</td>
                                    <td>{{ $calendario['valor'] }}</td>
                                    <td>{{ $calendario['periodicidad'] }}</td>
                                    <td><a href="/calendarios/update/{{  $calendario['id'] }}"><button class="btn btn-warning">></button></a></td>
                                    <td><a href="/calendarios/delete/{{  $calendario['id'] }}"><button class="btn btn-danger">x</button></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
    </div>
</div>


<script>
var calendario = new Calendario();

calendario.ocultar();
$("#periodicidad").change(function(){
   calendario.dateshow($("#periodicidad").val());
});

function Calendario(){
    this.ocultar = function(){
        $('#finaldate').hide();
    };
    this.dateshow = function(periodicidad){
        var fechainicial = $('#fecha_inicio').val();
        var horainicial = $('#hora_inicio').val();
        if(periodicidad=='uno'){
            $('#finaldate').show(100);
        }
        else  if(periodicidad=='diario'){
            $('#fecha_final').val(fechainicial);
            $('#hora_final').val(horainicial);
            $('#finaldate').hide();
        }
        else  if(periodicidad=='semanal'){
            $('#fecha_final').val(fechainicial);
            $('#hora_final').val(horainicial);
            $('#finaldate').hide();
        }
        else  if(periodicidad=='mensual'){
            $('#fecha_final').val(fechainicial);
            $('#hora_final').val(horainicial);
            $('#finaldate').hide();
        }
        else  if(periodicidad=='ano'){
            $('#fecha_final').val(fechainicial);
            $('#hora_final').val(horainicial);
            $('#finaldate').hide();
        }
        else{
            $('#finaldate').hide();
        }
    };
}
</script>

@endsection()