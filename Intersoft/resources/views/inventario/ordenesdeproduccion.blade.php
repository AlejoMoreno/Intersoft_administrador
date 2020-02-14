@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Ordenes de Producción</h4>
                    <p class="category">Crea fichas técnicas de producción <a href="ordenesproduccion" class="btn btn-success" style="background:white;">Nueva</a></p>
                </div>
                <div class="content">
                    <table class="table table-hover table-striped" id="tableregimenes">
                        <thead>
                            <tr>
                                <th>Código orden</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fichatecnicas as $obj)
                                <tr>
                                    <td>{{ $obj->orden }}</td>
                                    <td>{{ $obj->nombre }}</td>
                                    <?php $url = "?orden=".$obj->orden;  ?>
                                    <td><a href="{{ $url }}" class="btn btn-warning">Actualizar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection()