@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="header">
                    <h4 class="title">Directorio</h4>
                    <p class="category">Nota: Las imagenes que se muestran a continuación representan un link a donde podrás viajar por intersoft.</p>
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
                            <i class="fa fa-clock-o"></i> Ir a la sección del manual
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Sub menu Directorio</h4>
                    <p class="category">Elige que quieres hacer</p>
                </div>
                <div class="content">
                    <div> 
                    <table class="table table-hover table-striped"  id="datos">
                                    <thead>
                                        <tr><th></th>
                                        <th>Opcion</th>
                                        <th></th>
                                    </tr></thead>
                                    <tbody>
                                        <tr onclick="config.Redirect('/administrador/directorios');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/png/512/265/265675.png"></td>
                                            <td>Creación, Consulta Directorio</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/departamentos');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/185/185277.svg"></td>
                                            <td>Departamentos</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/ciudades');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/189/189060.svg"></td>
                                            <td>Ciudades</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/calendario');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/123/123392.svg"></td>
                                            <td>Calendario</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/usuarios');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/svg/201/201570.svg"></td>
                                            <td>Usuarios</td>
                                            <td><img width="20" onclick="config.Intoredirect('administrador/usuarios.html');" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/directorio_clases');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/png/512/485/485280.png"></td>
                                            <td>Directorio Clases</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/directorio_tipos');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/png/512/485/485482.png"></td>
                                            <td>Directorio tipos</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/directorio_tipo_terceros');">
                                            <td><img width="30" src="https://image.flaticon.com/icons/png/512/148/148971.png"></td>
                                            <td>Directorio Tipo Terceros</td>
                                            <td><img width="20" src="https://image.flaticon.com/icons/svg/265/265727.svg">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> 
                            <i class="fa fa-circle text-danger"></i> 
                            <i class="fa fa-circle text-warning"></i>
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="pe-7s-angle-left-circle"></i> <a href="#" onclick="config.Redirect('/index');"> ir atras.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()

