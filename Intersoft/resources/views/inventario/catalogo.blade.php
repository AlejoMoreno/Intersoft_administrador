@extends('layout')

@section('content')


<div class="enc-article">
  <h4 class="title">Catálogo productos</h4>
</div>

<br><br>
<div class="row top-11-w">
  <div class="col-md-12">
      <h4 class="title">Referencias</h4>
      <p class="category">Diferentes referencias</p>
  </div>
  <div class="col-md-2">
      <p>Ordenar:</p>
      <select name="orden" id="orden" class="form-control">
          <option value="codigo">Por Código</option>
          <option value="nombre">Por Nombre</option>
          <option value="codigo_linea">Por Linea</option>
          <option value="id_marca">Por Marca</option>
          <option value="costo">Por Costo</option>
          <option value="saldo">Por Saldo</option>
      </select>
  </div>
  <div class="col-md-2">
      <p>Tipo Reporte:</p>
      <select name="tipo_reporte" id="tipo_reporte" class="form-control">
          <option value="total">Total</option>
          <option value="exitencia">Con Existencia</option>
      </select>
  </div>
  <div class="col-md-2">
      <p>Linea</p>
      <select name="linea" id="linea" class="form-control" >
          <option value="0">TODAS</option>
          @foreach ($lineas as $linea)
          <option value="{{ $linea->id }}">{{ $linea->id }} - {{ $linea->nombre }}</option>
          @endforeach
      </select>
  </div>
  <div class="col-md-2">
    <div onclick="referencias.envioPDFlistaprecios(1)" style="background: white;" class="btn btn-danger">(PDF) Precios 1</div>
  </div>
  <div class="col-md-2">
    <div onclick="referencias.envioPDFlistaprecios(2)" style="background: white;" class="btn btn-danger">(PDF) Precios 2</div>
  </div>
  <div class="col-md-2">
    <div onclick="referencias.envioPDFlistaprecios(3)" style="background: white;" class="btn btn-danger">(PDF) Precios 3</div>
  </div>
</div>

<br><br>
<div class="row top-11-w">
  <h6 style="margin-left: 2%;">12 Productos más vendidos</h6>
  <div class="col-md-11 row" style="overflow-x:scroll;margin-left:2%">
    
    @foreach($referenciasmasvendidas as $obj)
    <div class="col-md-3">
      <div class="thumbnail">
        <div class="caption text-center">
          <div class="position-relative">
            <img src="/assets/img/productos/0.png" style="width:72px;height:72px;" />
          </div>
          <h4 id="thumbnail-label"><a class="btn btn-info" href="/kardex/show/{{ $obj['id_referencia']['id'] }}" target="_blank">{{ $obj['id_referencia']['codigo_barras'] }} Kardex</a></h4>
          <p>Vendidos  <?php echo number_format($obj['total']);  ?></p>
          <div class="thumbnail-description smaller"> <strogn>{{ $obj['id_referencia']['descripcion'] }}</strogn> {{ $obj['id_referencia']['id_marca'] }} {{ $obj['id_referencia']['id_presentacion'] }}</div>
        </div>
        <div class="caption card-footer text-center">
          <ul class="list-inline">
            <li><small>Venta </small><strong>$ <?php echo number_format($obj['id_referencia']['precio1']);  ?></strong></li>            
            <li><small>Costo </small><strong>$ <?php echo number_format($obj['id_referencia']['costo4']);  ?></li>
            <li></li>
            <li><small>Saldo </small><strong> <?php echo number_format($obj['id_referencia']['saldo']);  ?></strong></li>
          </ul>
        </div>
      </div>
    </div>
    @endforeach

  </div>
  
</div>

<br><hr>
<div class="row top-11-w">
  <h6 style="margin-left: 2%;">12 Productos más pedidos</h6>
  <div class="col-md-11 row" style="overflow-x:scroll;margin-left:2%">
    
    @foreach($referenciasmaspedidos as $obj)
    <div class="col-md-3">
      <div class="thumbnail">
        <div class="caption text-center">
          <div class="position-relative">
            <img src="/assets/img/productos/1.png" style="width:72px;height:72px;" />
          </div>
          <h4 id="thumbnail-label"><a class="btn btn-info" href="/kardex/show/{{ $obj['id_referencia']['id'] }}" target="_blank">{{ $obj['id_referencia']['codigo_barras'] }} Kardex</a></h4>
          <p>Vendidos  <?php echo number_format($obj['total']);  ?></p>
          <div class="thumbnail-description smaller"> <strogn>{{ $obj['id_referencia']['descripcion'] }}</strogn> {{ $obj['id_referencia']['id_marca'] }} {{ $obj['id_referencia']['id_presentacion'] }}</div>
        </div>
        <div class="caption card-footer text-center">
          <ul class="list-inline">
            <li><small>Venta </small><strong>$ <?php echo number_format($obj['id_referencia']['precio1']);  ?></strong></li>            
            <li><small>Costo </small><strong>$ <?php echo number_format($obj['id_referencia']['costo4']);  ?></li>
            <li></li>
            <li><small>Saldo </small><strong> <?php echo number_format($obj['id_referencia']['saldo']);  ?></strong></li>
          </ul>
        </div>
      </div>
    </div>
    @endforeach

  </div>
  
</div>


<br><hr>
<div class="row top-11-w">
  <h6 style="margin-left: 2%;">12 Productos menos vendidos</h6>
  <div class="col-md-11 row" style="overflow-x:scroll;margin-left:2%">
    
    @foreach($referenciasmaspedidos as $obj)
    <div class="col-md-3">
      <div class="thumbnail">
        <div class="caption text-center">
          <div class="position-relative">
            <img src="/assets/img/productos/3.png" style="width:72px;height:72px;" />
          </div>
          <h4 id="thumbnail-label"><a class="btn btn-info" href="/kardex/show/{{ $obj['id_referencia']['id'] }}" target="_blank">{{ $obj['id_referencia']['codigo_barras'] }}  Kardex</a></h4>
          <p>Vendidos  <?php echo number_format($obj['total']);  ?></p>
          <div class="thumbnail-description smaller"><strogn>{{ $obj['id_referencia']['descripcion'] }}</strogn> {{ $obj['id_referencia']['id_marca'] }} {{ $obj['id_referencia']['id_presentacion'] }}</div>
        </div>
        <div class="caption card-footer text-center">
          <ul class="list-inline">
            <li><small>Venta </small><strong>$ <?php echo number_format($obj['id_referencia']['precio1']);  ?></strong></li>            
            <li><small>Costo </small><strong>$ <?php echo number_format($obj['id_referencia']['costo4']);  ?></li>
            <li></li>
            <li><small>Saldo </small><strong> <?php echo number_format($obj['id_referencia']['saldo']);  ?></strong></li>
          </ul>
        </div>
      </div>
    </div>
    @endforeach

  </div>
  
</div>

<br>
<hr>
<br>
<div class="row top-11-w">
  <p style="font-size:10pt;font-family:Poppins;margin-left:2%">Otras referencias</p>
  <div class="col-md-11" style="overflow-x:scroll;margin-left:2%">
      <table class="table table-sm  table-striped" id="datos">
          <thead>
              <tr>
                  <th>Codigo</th>
                  <th>Descripción</th>
                  <th>Saldo</th>
                  <th>Costo</th>
                  <th>Venta</th>
                  <th>Kardex</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($referencias as $obj)
                  <tr>
                    <td>{{ $obj['codigo_barras'] }} </td>
                    <td><strogn>{{ $obj['descripcion'] }}</strogn></td>
                    <td><?php echo number_format($obj['saldo']);  ?></td>
                    <td>$ <?php echo number_format($obj['costo4']);  ?></td>
                    <td>$ <?php echo number_format($obj['precio1']);  ?></td>
                    <td><a class="btn btn-info" href="/kardex/show/{{ $obj['id'] }}" target="_blank">Kardex</a></td>
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
</script>
@endsection()