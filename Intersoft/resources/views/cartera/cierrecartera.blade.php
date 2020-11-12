@extends('layout')

@section('content')


<div class="enc-article">
  <h4 class="title">Cierres de Cartera</h4>
</div>


<div class="row top-11-w">
  <p style="font-size:10pt;font-family:Poppins;margin-left:2%">Cierres</p>
  <div class="col-md-4" style="overflow-x:scroll;margin-left:2%">
      <table class="table table-sm  table-striped" id="datos">
          <thead>
              <tr>
                  <th>Cierre</th>
                  <th>Cantidad terceros</th>
                  <th></th>
              </tr>
          </thead>
          <tbody>
              @foreach ($cierres as $obj)
                  <tr>
                      <td>{{ $obj['fecha'] }}</td>
                      <td style="text-align: center">{{ $obj['count'] }}</td>
                      <td><a href="javascript:;" class="btn btn-info">Ver</a></td>
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>

  <div class="col-md-7" style="overflow-x:scroll;margin-left:2%">
    <h2 class="title">Generar cierre de cartera</h2>
    <form method="POST" action="/cartera/cierreCartera" class="row" style="margin:2%;">
        <div class="col-md-6" style="padding:2%">
            <input class="form-control" type="date" name="fecha">
        </div>
        <div class="col-md-6" style="padding:2%">
            <input type="submit" class="form-control btn btn-success" style="background: #3c763d;color:white;" value="Generar">
        </div>
    </form>
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