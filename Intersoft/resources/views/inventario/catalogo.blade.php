@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

    	<div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Todos los Productos</h4>
                    <p class="category"><input type="search" style="width: 20%;" name="search" id="buscador_catalogo" onkeyup="Buscar_Producto_catalogo()" placeholder="Buscar" class="form-control"></p><br>
                </div>
                <div class="content" id="impirmir">
                	<div class="row" style="overflow-y:scroll;height:500px;">
                		@foreach($referencias as $obj)
                		<div class="col-md-2 ficha_tecnica">
                			<strong>{{ $obj->descripcion }}</strong>
                			<br>{{ $obj->codigo_barras }}
                			<br>{{ $obj->id_presentacion[0]->nombre }}
                			<br>{{ $obj->id_marca[0]->nombre }}
                			<br>{{ $obj->codigo_linea[0]->nombre }}
                			<br><small>Venta </small><strong>$ <?php echo number_format($obj->precio1);  ?></strong>
                			<br><small>Costo </small><strong>$ <?php echo number_format($obj->costo4);  ?></strong>
                			<br><small>Saldo </small><strong> <?php echo number_format($obj->saldo);  ?></strong>
                            <br><a class="btn btn-info" href="/kardex/show/{{ $obj->id }}" target="_blank">Kardex</a>
                		</div>

                		@endforeach
                	</div>
        		</div>
        	</div>
        </div>

        <style type="text/css">
        	.ficha_tecnica{
        		-webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
        		-moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
        		box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
        		padding: 2%;
        		margin: 1%;
        	}
        </style>

        <script>
            function Buscar_Producto_catalogo() {
              // Declare variables 
              var input, filter, table, tr, td, i, txtValue;
              input = document.getElementById("buscador_catalogo");
              filter = input.value.toUpperCase();
              fichas = document.getElementsByClassName("ficha_tecnica");
              // Loop through all table rows, and hide those who don't match the search query
              for (i = 0; i < fichas.length; i++) {
                txtValue = fichas[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    fichas[i].style.display = "";
                  } else {
                    fichas[i].style.display = "none";
                  }
              }
            }
            </script>

    </div>
</div>

@endsection()