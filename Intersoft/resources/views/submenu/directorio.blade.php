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
                                        <tr onclick="config.Redirect('/administrador/index');">
                                            <td><img width="30" src="/assets/148912.svg"></td>
                                            <td colspan="2">Parámetros</td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/directorios');">
                                            <td><img width="30" src="/assets/265675.png"></td>
                                            <td>Creación, Consulta Directorio</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/calendario');">
                                            <td><img width="30" src="/assets/123392.svg"></td>
                                            <td>Calendario</td>
                                            <td><img width="20" src="/assets/265727.svg">
                                            </td>
                                        </tr>
                                        <tr onclick="config.Redirect('/administrador/usuarios');">
                                            <td><img width="30" src="/assets/201570.svg"></td>
                                            <td>Usuarios</td>
                                            <td><img width="20" onclick="config.Intoredirect('administrador/usuarios.html');" src="/assets/265727.svg">
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

