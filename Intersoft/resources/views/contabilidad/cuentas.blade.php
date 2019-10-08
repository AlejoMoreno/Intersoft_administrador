@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Cuentas (PUC)</h4>
                    <p class="category">PUC</p>
                </div>
                <div class="content">

                    <input placeholder="escribe la cuenta a buscar" type="text" id="puc" name="puc" class="form-control" onkeyup="cuentaContable.buscarPUC($('#puc').val());">
                    
                    <form action='/contabilidad/cuentas/create' method="POST">
                        <div class="row">
                            <input type="hidden" id="id" name="id" >
                            <label class="col-md-2">Clase: </label>
                            <div class="col-md-4">
                                <input type="text" id="cuentaClase" name="clase" onkeyup="cuentaContable.buscar($('#cuentaClase').val());" class="form-control" value="0" autocomplete="off" maxlength="1">
                            </div>
                            <label class="col-md-2">Nombre Clase: </label>
                            <div class="col-md-4">
                                <input type="text" id="nombreClase" name="nombreClase" class="form-control" value="NA" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-2">Grupo: </label>
                            <div class="col-md-4">
                                <input type="text" id="cuentaGrupo" name="grupo" onkeyup="cuentaContable.buscar($('#cuentaGrupo').val());" class="form-control" value="0" autocomplete="off" maxlength="1">
                            </div>
                            <label class="col-md-2">Nombre grupo: </label>
                            <div class="col-md-4">
                                <input type="text" id="nombreGrupo" name="nombreGrupo" class="form-control" value="NA" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-2">cuenta: </label>
                            <div class="col-md-4">
                                <input type="text" id="cuentaCuenta" name="cuenta" onkeyup="cuentaContable.buscar($('#cuentaCuenta').val());" class="form-control" value="0" autocomplete="off" maxlength="2">
                            </div>
                            <label class="col-md-2">Nombre cuenta: </label>
                            <div class="col-md-4">
                                <input type="text" id="nombreCuenta" name="nombreCuenta" class="form-control" value="NA" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-2">subcuenta: </label>
                            <div class="col-md-4">
                                <input type="text" id="cuentaSubcuenta" name="subcuenta" onkeyup="cuentaContable.buscar($('#cuentaSubcuenta').val());" class="form-control" value="0" autocomplete="off"  maxlength="2">
                            </div>
                            <label class="col-md-2">Nombre subcuenta: </label>
                            <div class="col-md-4">
                                <input type="text" id="nombreSubcuenta" name="nombreSubcuenta" class="form-control" value="NA" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-2">auxiliar: </label>
                            <div class="col-md-4">
                                <input type="text" id="cuentaAuxiliar" name="auxiliar" onkeyup="cuentaContable.buscar($('#cuentaAuxiliar').val());" class="form-control" value="0" autocomplete="off"  maxlength="2">
                            </div>
                            <label class="col-md-2">Nombre auxiliar: </label>
                            <div class="col-md-4">
                                <input type="text" id="nombreAuxiliar" name="nombreAuxiliar" class="form-control" value="NA" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-md-2">homologo: </label>
                            <div class="col-md-4">
                                <input type="text" id="cuentaHomologo" name="homologo" class="form-control" value="0" autocomplete="off">
                            </div>
                            <label class="col-md-2">homologo_1: </label>
                            <div class="col-md-4">
                                <input type="text" id="cuentaHomologo_1" name="homologo_1" class="form-control" value="0" autocomplete="off">
                            </div>
                        </div>
                        <div class="row"><br><input type="submit" value="Guardar" id="btnguardar" class="btn btn-success form-control"></div>
                        <div class="row"><br><div id="actualizar" onclick="cuentaContable.sendUpdate()" class="btn btn-warning form-control">Actualizar</div></div>
                    </form>

                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/contabilidad/index');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection()