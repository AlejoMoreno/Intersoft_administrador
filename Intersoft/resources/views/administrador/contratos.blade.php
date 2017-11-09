@extends('layout')

@section('content')


<div class="container-fluid">
    @foreach( $contrato_laborales as $contrato )
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Contratos Numero {{ $contrato['id'] }}</h4><br>
                    <p class="category">Contrato: {{ $contrato['tipo_contrato'] }}</p><br><br><br>
                    <p>{{ $contrato['descripcion'] }}</p>
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
        </div>
    </div>
    @endforeach
</div>


@endsection()