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
                        <label>Tipo Contrato</label><input type="text" name="tipo_contrato" class="form-control" placeholder="Escribir el tipo de contrato">
                        <label>Consecutivo</label><input type="number" name="consecutivo" class="form-control" placeholder="Conseutivo del contrato">
                        <label>Fecha Inicial</label><input type="date" name="fecha_inicial" class="form-control">
                        <label>Fecha Final</label><input type="date" name="fecha_final" class="form-control">
                        <p>* Se indica que si se quiere hacer referencia a el nombre del usuario se debe hacer __nombre__ y la cedula __cedula__ </p>
                        <div id="sample">
                            <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
                            //<![CDATA[
                                    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
                            //]]>
                            </script>
                            <textarea id="descripcion" name="descripcion" style="width: 100%;">
                                    <center><strong>CONTRATO DE PRESTACION DE SERVICIO</strong></center><br>
                                        <center><strong> __numero__ </strong></center><br><br>

El señor __nombre__ con la cedula __cedula__, se presenta para realizar trabajos de servicio como desarrollo de software, por un valor de $2.000.000 de pesos colombianos.<br><br>
<br><br>
Autorizado por: 
<br>
<strong>Alejandro Moreno Castro
Gerente General</strong>
                            </textarea>
                        </div>
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