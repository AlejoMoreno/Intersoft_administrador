@extends('layout')

@section('content')



<style>
.title{
    margin-left: 2%;
    font-weight: bold;
    font-family: Poppins;
}
.top-5-w{
    margin-top:5%;
}
.table > thead th {
    -webkit-animation: pantallain 100s infinite; /* Safari 4.0 - 8.0 */
    -webkit-animation-direction: alternate; /* Safari 4.0 - 8.0 */
    animation: pantallain 100s infinite;
    animation-direction: alternate;
}
.red{
    background: #ff4a55;
    color: white;
}
</style>

<div class="enc-article">
    <h4 class="title">Cartera inicial</h4>
</div>

<div class="row top-5-w">
    <div style="margin-left: 5%;width: 90%;">
        @if (session('alert'))
            <div class="alert alert-success">
                {{ session('alert') }}
            </div>
        @endif
        <form method="post" action="" class="row">
            <div class="col-md-1 ">
                <label for="numero">Número</label>
                <input class="form-control" name="numero" id="numero">
            </div>
            <div class="col-md-1 ">
                <label for="prefijo">prefijo</label>
                <input class="form-control" name="prefijo" id="prefijo">
            </div>
            <div class="col-md-3 ">
                <label for="id_cliente">Tercero</label>
                <input class="form-control" name="id_cliente" id="id_cliente">
            </div>
            <div class="col-md-3 ">
                <label for="id_vendedor">Vendedor</label>
                <select class="form-control" name="id_vendedor" id="id_vendedor">
                @foreach($vendedor as $obj)
                <option value="{{ $obj->id }}">{{ $obj->apellido }} {{ $obj->nombre }}</option>
                @endforeach
                </select>
            </div>
            <div class="col-md-2 ">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" name="fecha" id="fecha">
            </div>
            <div class="col-md-2 ">
                <label for="fecha_vencimiento">Fecha vencimiento</label>
                <input type="date" class="form-control" name="fecha_vencimiento" id="fecha_vencimiento">
            </div>
            <div class="col-md-2 ">
                <label for="id_documento">Documento</label>
                <select class="form-control" name="id_documento" id="id_documento">
                @foreach($documentos as $obj)
                <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                @endforeach
                </select>
            </div>
            <div class="col-md-2 ">
                <label for="subtotal">subtotal</label>
                <input class="form-control" name="subtotal" id="subtotal">
            </div>
            <div class="col-md-2 ">
                <label for="iva">iva</label>
                <input class="form-control" name="iva" id="iva">
            </div>
            <div class="col-md-2 ">
                <label for="impoconsumo">impoconsumo</label>
                <input class="form-control" name="impoconsumo" id="impoconsumo">
            </div>
            <div class="col-md-2 ">
                <label for="otro_impuesto">ICA</label>
                <input class="form-control" name="otro_impuesto" id="otro_impuesto">
            </div>
            <div class="col-md-2 ">
                <label for="otro_impuesto1">Rete iva</label>
                <input class="form-control" name="otro_impuesto1" id="otro_impuesto1">
            </div>
            <div class="col-md-2 ">
                <label for="descuento">descuento</label>
                <input class="form-control" name="descuento" id="descuento">
            </div>
            <div class="col-md-2 ">
                <label for="fletes">fletes</label>
                <input class="form-control" name="fletes" id="fletes">
            </div>
            <div class="col-md-2 ">
                <label for="retefuente">retefuente</label>
                <input class="form-control" name="retefuente" id="retefuente">
            </div>
            <div class="col-md-2 ">
                <label for="total">total</label>
                <input class="form-control" name="total" id="total">
            </div>
            <div class="col-md-2 ">
                <label for="observaciones">observaciones</label>
                <input class="form-control" name="observaciones" id="observaciones">
            </div>
            <div class="col-md-2 ">
                <label for="saldo">saldo</label>
                <input class="form-control" name="saldo" id="saldo">
            </div>
            <div class="col-md-2 ">
                <br>
                <input type="submit" value="Guardar" name="Guardar" class="btn btn-success">
            </div>
            <div class="col-md-5 ">
                <br>
            </div>
        </form>
    </div>
    
</div>


@endsection()

