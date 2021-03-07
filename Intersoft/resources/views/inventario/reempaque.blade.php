@extends('layout')

@section('content')


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
</style>
    

<div class="enc-article">
    <h4 class="title">Conformar producto Terminado</h4>
</div>

<div class="row top-5-w" style="padding:2%;">
    <p>
        Formulario para Conformar producto Terminado productos a partir de una ficha técnica.
    </p>

    <div class="panel panel-default col-md-5" >
        <!-- Default panel contents -->
        <div class="panel-heading row"><h5>Vista de fichas</h5></div>
        <div class="panel-body" >
            <p style="font-size: 10pt;">A contiuación se describe la lista de fichas existentes en el sistema, aqui usted puede realizar la actualización de cada uno de las fichas con el boton <i style="font-size: 11px;" class="fas fa-plus-circle"></i>.<br>
                Además podrá imprimir la ficha identificando cada uno de los productos que lo componen.
            </p>
        </div>
    </div>

    <div class="col-md-7 row">
        <div class="panel panel-warning col-md-12" >
            <!-- Default panel contents -->
            <div class="panel-heading row" >
                <h5 class="col-md-8">Creación de producto Terminado </h5>
                <div class="col-md-4 row">
                    <div class="col-md-3"><a href="/inventario/reempaque" class="btn btn-danger" style="background:white;"><i class="fas fa-plus-circle"></i> Nuevo </a></div>
                </div>                
            </div>
            <div class="panel-body" >
                <p style="font-size: 10pt;">Diligencie cada uno de los datos relacionados para Conformar producto Terminado, recuerde que el nombre de la ficha debe coincidir con el nombre del producto nuevo.
                </p>
                <form action='/inventario/reempaque'' method="POST" >
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-4">Creación  </div>
                                <div class="col-md-12">
                                    <label style="color:white">Cantidad</label>
                                    <input type="number" class="form-control" name="cantidad">
                                </div>
                                <div class="col-md-6">
                                    <label style="color:white">Fecha</label>
                                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="fecha">
                                </div>
                                <div class="col-md-6">
                                    <label style="color:white">Fecha caducidad / vencimiento:</label>
                                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="fecha_vencimiento">
                                </div>
                                <div class="col-md-12">
                                    <label style="color:white">Fichas técnicas</label>
                                    <select name="ficha" id="ficha" class="form-control" onchange="seleccionarProducto()">
                                        @foreach ($fichas as $ref)
                                            <option value="{{ $ref['orden'] }}'">{{ $ref['nombre'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label style="color:white">Producto a crear</label>
                                    <select name="producto" id="producto" class="form-control">
                                        @foreach ($referencias as $ref)
                                            <option value="{{ $ref['id'] }}'">{{ $ref['descripcion'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <input type="submit" value="Cargar" class="btn btn-success">
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </form>
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
}

function seleccionarProducto(){
    ficha = $('#ficha option:selected').text();
    console.log(ficha);
    $("#producto").find('option:contains("'+ficha+'")').prop('selected', true);

}
</script>


@endsection()