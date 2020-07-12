@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4 class="title">Referencias</h4>
                    <p class="category">Buscar referencias</p><br>
                </div>
                <div class="content">
                    <form method="GET" action="/inventario/actualizacionPrecios">
                        <div class="row">
                            <div class="col-md-6">
                                <select name="codigo_linea" id="codigo_linea" class="form-control">
                                    <option value="0">Codigo linea</option>
                                    @foreach ($lineas as $obj)
                                    <option value="{{ $obj['id'] }}">{{ $obj['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="id_marca" id="id_marca" class="form-control">
                                    <option value="0">Marca</option>
                                    @foreach ($marcas as $obj)
                                    <option value="{{ $obj['id'] }}">{{ $obj['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="id_clasificacion" id="id_clasificacion" class="form-control">
                                    <option value="0">Clasificacion</option>
                                    @foreach ($clasificacion as $obj)
                                    <option value="{{ $obj['id'] }}">{{ $obj['nombre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="estado" id="estado" class="form-control">
                                    <option value="0">Estado</option>
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input placeholder="descripcion" class="form-control" type="text" name="descripcion" id="descripcion">
                            </div>
                            <div class="col-md-6">
                                <input type="number" placeholder="saldo" class="form-control"  name="saldo" id="saldo">
                            </div>
                            <div class="col-md-12">
                                <input type="submit" value="Buscar" name="buscar" style="width: 100%" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                    <p style="font-size:10px;">Para realizar cambios a la lista de precios uno a uno debe buscar el producto y dar dobleclick a los tres valores que existen en azul</p>
                    <div style="overflow-x:scroll;overflow-y:scroll;height:500px;">
                        <table class="table table-hover table-striped" id="datos">
                            <thead>
                                <tr>
                                    <th>codigo</th>
                                    <th>descripcion</th>
                                    <th>nombre</th>
                                    <th>precio1</th>
                                    <th>precio2</th>
                                    <th>precio3</th>
                                    <th>precio4</th>
                                    <th>estado</th>
                                    <th>costo</th>
                                    <th>saldo</th>
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                    
                        
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

        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h4>Actualizar Precios</h4>
                </div>
                <div class="content">
                    <form >
                        <div class="row">
                            <label class="col-md-6">Factor Rendimiento:</label>
                            <div class="col-md-6"><input class="form-control" placeholder="(%)" name="factor_rendimiento" id="factor_rendimiento"></div>
                            <div class="col-md-12"><button value="Buscar" name="buscar" style="width: 100%" class="btn btn-success">Buscar</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {
    referencias = {!! json_encode($referencias) !!};
    $('#datos').DataTable( {
        data: referencias,
        columns: [
            { data: 'codigo' },
            { data: 'descripcion' },
            { data: 'nombre' },
            { data: 'precio1' },
            { data: 'precio2' },
            { data: 'precio3' },
            { data: 'precio4' },
            { data: 'estado' },
            { data: 'costo' },
            { data: 'saldo' },
            { id: 'id' }
        ],
        columnDefs: [
            {
                targets: 10,
                render: function ( id, type, row, meta ) {
                    if(type === 'display'){
                        data = '<a href="javascript:;" onclick="actualizarPrecio('+row.id+','+id+')" class="btn btn-warning">Actualizar</a>';
                    }
                    return data;
                }
            },
            {
                targets: 3,
                render: function ( data, type, row, meta ) {
                    if(type === 'display'){
                        data = '<div ondblclick="changeToPrecio1('+row.id+',this)" class="success"><label>'+data+'</label></div>';
                    }
                    return data;
                }
            },
            {
                targets: 4,
                render: function ( data, type, row, meta ) {
                    if(type === 'display'){
                        data = '<div ondblclick="changeToPrecio2('+row.id+',this)" class="success"><label>'+data+'</label></div>';
                    }
                    return data;
                }
            },
            {
                targets: 5,
                render: function ( data, type, row, meta ) {
                    if(type === 'display'){
                        data = '<div ondblclick="changeToPrecio3('+row.id+',this)" class="success"><label>'+data+'</label></div>';
                    }
                    return data;
                }
            }
        ]     
    } );
    
} );

function actualizarPrecio(row, id){
    var urls = "/inventario/actualizacionPrecios";
    
    precio1 = $('#precio1'+row).val();
    precio2 = $('#precio2'+row).val();
    precio3 = $('#precio3'+row).val();
    
    config.Redirect(urls+'/'+row+'/'+precio1+'/'+precio2+'/'+precio3);
}
function changeToPrecio1(data, element){
    console.log(data);
    var node = element;
    var label = node.firstChild;
    label.style.display = "none";
    var x = document.createElement("INPUT");
    x.setAttribute("type", "text");
    x.setAttribute("class", "form-control");
    x.setAttribute("id", "precio1"+data);
    x.setAttribute("value", label.innerText);
    node.appendChild(x);
}
function changeToPrecio2(data, element){
    var node = element;
    var label = node.firstChild;
    label.style.display = "none";
    var x = document.createElement("INPUT");
    x.setAttribute("type", "text");
    x.setAttribute("class", "form-control");
    x.setAttribute("id", "precio2"+data);
    x.setAttribute("value", label.innerText);
    node.appendChild(x);
}
function changeToPrecio3(data, element){
    var node = element;
    var label = node.firstChild;
    label.style.display = "none";
    var x = document.createElement("INPUT");
    x.setAttribute("type", "text");
    x.setAttribute("class", "form-control");
    x.setAttribute("id", "precio3"+data);
    x.setAttribute("value", label.innerText);
    node.appendChild(x);
}
</script>

@endsection()