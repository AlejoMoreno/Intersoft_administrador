@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Documentos Contables</h4>
                </div>
                <div class="content">
                    <table class="table table-hover table-striped" id="tableregimenes">
                        <thead>
                            <tr>
                                <th>Tipo Documento</th>
                                <th>Sucursal</th>
                                <th>Numero Documento</th>
                                <th>Prefijo</th>
                                <th>Fecha documento</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <table class="table table-hover table-striped" id="tableregimenes">
                            <thead>
                                <tr>
                                    <th>Tipo Documento</th>
                                    <th>Sucursal</th>
                                    <th>Numero Documento</th>
                                    <th>Prefijo</th>
                                    <th>Fecha documento</th>
                                    <th>Valor transaccion</th>
                                    <th>Tipo transaccion</th>
                                    <th>Cuenta contable</th>
                                    <th>Tercero</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>
<script type="text/javascript">
var obj = new Obj();
obj.initial();
function Obj(){
    this.initial = function(){
        $('.formulario_').hide();
    };
    this.value = function(input){
        if(config.getClave() == input.value){
             console.log('correcto');
             $('.formulario_').show();
        }
    };
}
</script>

@endsection()