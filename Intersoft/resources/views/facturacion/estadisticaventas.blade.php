@extends('layout')

@section('content')


  <style>
    #map { 
      width: 80%;
      height: 580px;
      box-shadow: 5px 5px 5px #888;
   }
  </style>

<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-11">
            <div class="card">
                <div class="header">
                    <h4 class="title">Ventas Reporte</h4>
                </div>
                <div class="content">
                    <div class="row">
                        
                        <div class="container">
                            <h1>Mi Ubicación: </h1>
                            <button onclick="getLocation()">Try It</button> 
                            <p id="demo"></p>
                            <input id="latitud">
                            <input id="Longitude">
                            <div id="map"></div>
                        </div>

                        
                        
                    </div>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/submenu/facturacion');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    var x = document.getElementById("demo");
    
    function getLocation() {
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
    }
    
    function showPosition(position) {
      x.innerHTML = "Latitude: " + position.coords.latitude + 
      "<br>Longitude: " + position.coords.longitude;
      console.log(position.coords);
      cargar_mapa(position.coords.latitude, position.coords.longitude);
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
</script>

  <script>
      function cargar_mapa(Llatitude, Llongitude){
        var map = L.map('map').
        setView([Llatitude, Llongitude],
        15);


        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
        maxZoom: 18
        }).addTo(map);

        L.control.scale().addTo(map);


        L.marker([Llatitude, Llongitude],{draggable: true}).addTo(map);


        /*L.Routing.control({
        waypoints: [
            L.latLng(Llatitude, Llongitude),
            L.latLng(4.5922997, -74.1469305)
        ]
        }).addTo(map);*/
      }
    


  </script>




@endsection()

