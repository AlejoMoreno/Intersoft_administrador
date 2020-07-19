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
</style>

<div class="enc-article">
    <h4 class="title">Extracto clientes / proveedores</h4>
</div>

<div class="row top-11-w">
    <div class="col-md-12" style="overflow-x:scroll;margin-left:2%">
        <p style="font-size:10pt;font-family:Poppins">Cartera por cobrar </p>
        <table class="table table-sm  table-striped" id="datos">
            
        </table>
    </div>

    <div class="col-md-12" style="overflow-x:scroll;margin-left:2%">
        <p style="font-size:10pt;font-family:Poppins">Cartera por pagar </p>
        <table class="table table-sm  table-striped" id="datos">
            {{ $carteraproveedor }}
        </table>
    </div>
    
</div>





<script>

</script>


@endsection()