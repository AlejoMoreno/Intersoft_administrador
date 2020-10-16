@extends('layout')

@section('content')

  <style>
      #map { 
      width: 100%;
      height: 380px;
   }
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
    <h4 class="title">Ubicar cliente en mapa</h4>
</div>

<div class="row top-5-w">
    <div class="col-md-12">
        <p style="font-size:10pt;font-family:Poppins;margin-left:1%;">Busque el cliente por nit, para traer la informacion y actualizar la ubicación en el mapa.</p>
    </div>
    <div class="col-md-3" style="margin-left:2%;padding:3%;background:#eee;">
        <label style="color:black">Nit</label>
        <input name="cedula_tercero" id="cedula_tercero" placeholder="nit" class="form-control" onkeyup="buscarcliente(this.value)">
        <input id="id" type="hidden" class="form-control">
        <label style="color:red" id="razon_social">xxx</label><br>
        <label style="color:red" id="direccion">xxx</label><br>
        <label style="color:black">Longitud</label>
        <input id="longitud" class="form-control">
        <label style="color:black">Latitud</label>
        <input id="latitud" class="form-control">   
        <br>
        <button class="btn btn-success" style="width: 100%;" onclick="saveDirectoriomaps()">Actualizar ubicación</button>                       
    </div>
    <div class="col-md-8">
        <div id="map"></div>
    </div>
</div>

<script>
$('#cedula_tercero').on('keydown', function(e) {
    if (e.key === "Enter") {
        buscarcliente($('#cedula_tercero').val());
        return false;
    }
});

function saveDirectoriomaps(){
    var urls = "/gps/directoriomaps";
    parametros = {
        "nit" : $('#cedula_tercero').val(),
        "id" : $('#id').val(),
        "direccion" : $('#direccion').text(),
        "longitud" : $('#longitud').val(),
        "latitud" : $('#latitud').val(),
        "accuracy" : "0"
    };
    $.ajax({
        data:  parametros,
        url:   urls,
        type:  'post',
        beforeSend: function () {
            $('#resultado').html('<p>Espere porfavor</p>');
        },
        success:  function (response) {
            console.log(response);
            swal({
                title: "Correcto",
                text: "Se actualizo el cliente",
                icon: "success",
                button: "Aceptar",
            });
        },
        error: function(){
            swal({
                title: "Algo anda mal",
                text: "Verifique conexión a internet y/o diligencie completamente los campos del encabezado",
                icon: "error",
                button: "Aceptar",
            });
        }
    });
}

function buscarcliente(texto){
    console.log(texto);
    if(texto.length > 3){
        var urls = "/administrador/diretorios/search/search";
        parametros = {
            "nit" : texto.trim()
        };
        $.ajax({
            data:  parametros,
            url:   urls,
            type:  'post',
            beforeSend: function () {
                $('#resultado').html('<p>Espere porfavor</p>');
            },
            success:  function (response) {
                console.log(response);
                if(response.body.length != 0){ // existe
                    cliente = response.body[0];
                    $('#razon_social').text(cliente.razon_social);
                    $('#direccion').text(cliente.direccion);
                    $('#id').val(cliente.id);           
                }  
                else{
                    $('#razon_social').text("xxx");
                    $('#direccion').text("xxx");
                    $('#id').val("0");  
                }              
            },
            error: function(){
                swal({
                  title: "Algo anda mal",
                  text: "Verifique conexión a internet y/o diligencie completamente los campos del encabezado",
                  icon: "error",
                  button: "Aceptar",
                });
            }
        });
    }
}

</script>

<script>

var map, newMarker, markerLocation;
$(function(){
    // Initialize the map
    // This variable map is inside the scope of the jQuery function.
    // var map = L.map('map').setView([38.487, -75.641], 8);

    // GET Lat long api geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, positionError, { enableHighAccuracy: true, maximumAge: 60000, timeout: 10000 });

    } else { 
        if (Modernizr.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, positionError, { enableHighAccuracy: true, maximumAge: 60000, timeout: 10000 });
        } else {
            swal({
                  title: "Algo anda mal",
                  text: "Verifique conexión a internet y/o diligencie completamente los campos del encabezado",
                  icon: "error",
                  button: "Aceptar",
                });
        }
    }
});

var newMarkerGroup = new L.LayerGroup();
var map;
function showPosition(position) {
    console.log(position.coords);
    // Now map reference the global map declared in the first line
    map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 15);

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
        maxZoom: 18
    }).addTo(map);
    
    map.on('click', addMarker);
}

function positionError(error)
{
    var message = "";

    // Check for known errors
    switch (error.code) {
        case error.PERMISSION_DENIED:
            message = "This website does not have your permission to use the Geolocation API";
            break;
        case error.POSITION_UNAVAILABLE:
            message = "Your current position could not be determined.";
            break;
        case error.PERMISSION_DENIED_TIMEOUT:
            message = "Your current position could not be determined within the specified timeout period.";
            break;
    }

    // If it's an unknown error, build a message that includes 
    // information that helps identify the situation, so that 
    // the error handler can be updated.
    if (message == "") {
        var strErrorCode = error.code.toString();
        message = "Your position could not be determined due to " +
                    "an unknown error (Code: " + strErrorCode + ").";
    }

    swal({
        title: "Algo anda mal",
        text: message,
        icon: "error",
        button: "Aceptar",
        });
}

function addMarker(e){
    // Add marker to map at click location; add popup window
    console.log(e);
    $('#latitud').val(e.latlng.lat);
    $('#longitud').val(e.latlng.lng);
    var newMarker = new L.marker(e.latlng).addTo(map);
}
    


</script>




@endsection()

