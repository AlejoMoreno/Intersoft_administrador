<html>
    <body>
        <center><h1>EMPRESA XYZ</h1></center>
        <p style="text-align:center">"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."<br><br>
        "No hay nadie que ame el dolor mismo, que lo busque, lo encuentre y lo quiera, simplemente porque es el dolor."</p>
        <p><strong>¿Qué es Lorem Ipsum?</strong><br>
            Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido 
            el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que 
            se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un 
            libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en
            documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación 
            de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de 
            autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>
        <table class="tg">
            <tr>
                <th class="tg-p1r8">id</th>
                <th class="tg-p1r8">nombre</th>
                <th class="tg-p1r8">codigo</th>
                <th class="tg-p1r8">direccion</th>
                <th class="tg-p1r8">encargado</th>
                <th class="tg-p1r8">ciudad</th>
                <th class="tg-p1r8">created_at</th>
            </tr>
            @foreach( $sucursales as $sucursal )
            <tr>
                <td>{{ $sucursal['id'] }}</td>
                <td>{{ $sucursal['nombre'] }}</td>
                <td>{{ $sucursal['codigo'] }}</td>
                <td>{{ $sucursal['direccion'] }}</td>
                <td>{{ $sucursal['encargado'] }}</td>
                <td>{{ $sucursal['ciudad']['nombre'] }}</td>
                <td>{{ $sucursal['created_at'] }}</td>
            </tr>
            @endforeach
        </table>

        <p>Traducción hecha por H. Rackham en 1914<br>
        "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born 
        and I will give you a complete account of the system, and expound the actual teachings of the great explorer 
        of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, 
        because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences
        that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, 
        because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great 
        pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some 
        advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no 
        annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>
    </body>
</html>


<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;left:10%;}
.tg td{font-family:Arial, sans-serif;font-size:10px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:10px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-p1r8{background-color:#010066;color:#ffffff}
.tg .tg-etfn{background-color:#010066;color:#ffffff;vertical-align:top}
.tg .tg-yzt1{background-color:#efefef;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>