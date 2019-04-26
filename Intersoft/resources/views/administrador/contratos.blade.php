@extends('layout')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4>Creación de contrato</h4>
                </div>
                <div class="content">
                    <form action='/administrador/contratos/create' method="POST">
                        <input type="text" name="tipo_contrato" class="form-control" placeholder="Escribir el tipo de contrato">
                        <input type="number" name="consecutivo" class="form-control" placeholder="Conseutivo del contrato">
                        <input type="date" name="fecha_inicial" class="form-control">
                        <input type="date" name="fecha_final" class="form-control">
                        <textarea id="content" name="descripcion"></textarea><br>
                        <input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control">
                    </form>
                </div>    
            </div>
        </div>
        <div class="col-md-12">
            @foreach( $contrato_laborales as $contrato )
            <div class="card">
                <div class="header">
                    <h4 class="title">Contrato # {{ $contrato['id'] }}</h4><br>
                    <p class="category">Contrato: {{ $contrato['tipo_contrato'] }}</p><br><br><br>
                    <?php  echo $contrato['descripcion']; ?>
                </div>
                <div class="content">
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
            @endforeach
        </div>
    </div>
</div>

<script>
 $R('#content');
</script>
@endsection()