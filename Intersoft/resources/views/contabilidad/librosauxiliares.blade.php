@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Libros Auxiliares</h4>
                    <p class="category">Libros auxiliares</p>
                </div>
                <div class="content">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <td>tipo_documento</td>
                                <td>sucursal</td>
                                <td>numero_documento</td>
                                <td>prefijo</td>
                                <td>valor_transaccion</td>
                                <td>tipo_transaccion</td>
                                <td>cuenta</td>
                                <td>descripcion</td>
                                <td>tercero</td>
                                <td>razon_social</td>
                                <td>fecha_documento</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $value) {
                            ?>
                            <tr>
                                <td><?php echo $value['tipo_documento'] ?></td>
                                <td><?php echo $value['sucursal'] ?></td>
                                <td><?php echo $value['numero_documento'] ?></td>
                                <td><?php echo $value['prefijo'] ?></td>
                                <td><?php echo $value['valor_transaccion'] ?></td>
                                <td><?php echo $value['tipo_transaccion'] ?></td>
                                <td><?php echo $value['cuenta'] ?></td>
                                <td><?php echo $value['descripcion'] ?></td>
                                <td><?php echo $value['tercero'] ?></td>
                                <td><?php echo $value['razon_social'] ?></td>
                                <td><?php echo $value['fecha_documento'] ?></td>
                            </tr>
                            <?php
                            } 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection()

