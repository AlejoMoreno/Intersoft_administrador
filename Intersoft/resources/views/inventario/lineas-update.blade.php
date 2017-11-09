@extends('layout')

@section('content')
<div id="from-update" >
    <h3 class="title">Actualiza Marcas</h3>
    <input type="hidden" name="upid_marca" id="upid_marca">
    <div class="form-group">
        <label>Nombre:</label>
        <input type="text" class="form-control" onkeyup="config.UperCase('upnombre');" name="upnombre" id="upnombre">
    </div>
    <div class="form-group">
        <label>Descripción:</label>
        <input type="text" class="form-control" onkeyup="config.UperCase('updescripcion');" name="updescripcion" id="updescripcion">
    </div>
    <button type="button" onclick="lineas.updateLineas();" id="update" class="form-control btn btn-info btn-fill pull-right">Actualizar</button>
    <div id="resultado"></div>
</div>
@endsection()