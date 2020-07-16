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
    var map = L.map('map').
       setView([4.5921339, -74.1260522],
       15);


    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
    maxZoom: 18
    }).addTo(map);

    L.control.scale().addTo(map);


    L.marker([41.66, -4.71],{draggable: true}).addTo(map);


    L.Routing.control({
    waypoints: [
        L.latLng(4.5921339, -74.1260522),
        L.latLng(4.5922997, -74.1469305)
    ]
    }).addTo(map);


  </script>

@endsection()

