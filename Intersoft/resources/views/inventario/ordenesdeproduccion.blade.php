@extends('layout')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <form action="/inventario/ordenesdeproduccion" method="POST">
                    <div class="header">
                        <h4 class="title">Ordenes de Producción</h4>
                        <p class="category">Crea orden de producción <a href="ordenesdeproduccion" class="btn btn-success" style="background:white;">Nueva</a></p>
                    </div>
                    <div class="content row">
                        <p class="col-md-12">Encabezado</p>
                        <label class="col-md-1">Fecha vencimiento</label>
                        <div class="col-md-3"><input type="date" class="form-control" name="fecha" id="fecha"></div>
                        <div class="col-md-2">
                            <select name="id_sucursa" class="form-control" id="id_sucursal">
                                <option value="">Seleccionar sucursal</option>
                                @foreach($sucursal as $obj)
                                <option value="{{ $obj->id }}" >{{ $obj->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2"><input type="number" class="form-control" value="{{ Session::get('id_empresa') }}" name="id_empresa" id="id_empresa"></div>
                        <div class="col-md-2"><input type="number" class="form-control" placeholder="orden de producción" name="orden_produccion" id="orden_produccion"></div>
                        <div class="col-md-2">
                            <select name="operario" class="form-control" id="operario">
                                <option value="">Seleccionar jefe producción</option>
                                @foreach($operario as $obj)
                                <option value="{{ $obj->id }}" >{{ $obj->ncedula }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="content row">
                        <p class="col-md-12">seleccione los productos</p>
                        <div class="col-md-2">
                            <select name="id_ficha_tecnica" class="form-control" id="id_ficha_tecnica">
                                <option value="">Seleccionar ficha tecnica</option>
                                @foreach($ficha_tecnica as $obj)
                                <option value="{{ $obj->id }}" >{{ $obj->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="id_turno" class="form-control" id="id_turno">
                                <option value="">Seleccionar turno</option>
                                <option value="1">Turno 1</option>
                                <option value="2">Turno 2</option>
                                <option value="3">Turno 3</option>
                                <option value="4">Turno 4</option>
                                <option value="5">Turno 5</option>
                                <option value="6">Turno 6</option>
                                <option value="7">Turno 7</option>
                                <option value="8">Turno 8</option>
                                <option value="9">Turno 9</option>
                                <option value="10">Turno 10</option>
                                <option value="11">Turno 11</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="id_referencia" class="form-control" id="id_referencia">
                                <option value="">Seleccionar referencia</option>
                                @foreach($referencia as $obj)
                                <option value="{{ $obj->id }}" >{{ $obj->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2"><input type="text" class="form-control" placeholder="Lote" name="lote" id="lote"></div>
                        <div class="col-md-2">
                            <select name="etapa" class="form-control" id="etapa">
                                <option value="">Seleccionar etapa</option>
                                <option value="1">Etapa 1</option>
                                <option value="2">Etapa 2</option>
                                <option value="3">Etapa 3</option>
                                <option value="4">Etapa 4</option>
                                <option value="5">Etapa 5</option>
                                <option value="6">Etapa 6</option>
                                <option value="7">Etapa 7</option>
                                <option value="8">Etapa 8</option>
                                <option value="9">Etapa 9</option>
                                <option value="10">Etapa 10</option>
                                <option value="11">Etapa 11</option>
                            </select>
                        </div>
                        <div class="col-md-2"><input type="number" placeholder="cantidad" class="form-control" name="unidades" id="unidades"></div>
                    </div>
                    <div class="content">
                        <input type="submit" value="Guardar" class="form-control btn btn-success">
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="header">
                    <p class="category">Lista de orden de producción # 3</p>
                </div>
                <div class="content row">

                </div>
            </div>
        </div>
    </div>
</div>


@endsection()