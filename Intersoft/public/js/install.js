var install = new Install();
function Install(){

    this.mostrar = function(){
        $("#install_2").css("display","");
    }
    
    this.getciudades = function(){
        $.ajax({
			url:   HOST+'/ciudades/all',
			type:  'get',
			success:  function (response) {
                console.log(response);
                response.body.forEach(function(element) {
                    $('#ciudad').append("<option value='"+element.id+"'>"+element.nombre+"</option>");
                }, this);
			}
        });
    }

    this.getdepartamento = function(){
        $.ajax({
			url:   HOST+'/departamentos/all',
			type:  'get',
			success:  function (response) {
                console.log(response);
                response.body.forEach(function(element) {
                    $('#departamento').append("<option value='"+element.id+"'>"+element.nombre+"</option>");
                }, this);
			}
        });
    }

    this.getregimenes = function(){
        $.ajax({
			url:   HOST+'/regimenes/all',
			type:  'get',
			success:  function (response) {
                console.log(response);
                response.body.forEach(function(element) {
                    $('#id_regimen').append("<option value='"+element.id+"'>"+element.nombre+"</option>");
                }, this);
			}
        });
    }

    this.botonInstalar = function(){
        if(
            $('#razon_social').val() == '' ||
            $('#nit_empresa').val() == '' ||
            $('#nombre').val() == '' ||
            $('#actividad').val() == '' ||
            $('#dian_nit').val() == ''
        ){
            alert('Todos los campos Seccion1 con * deben ir diligenciados');
        }
        else if( 
            $('#telefono').val() == '' ||
            $('#telefono1').val() == '' ||
            $('#telefono2').val() == '' ||
            $('#direccion').val() == '' ||
            $('#departamento').val() == '' ||
            $('#ciudad').val() == '' ||
            $('#id_regimen').val() == ''
        ){
            alert('Todos los campos Seccion2 con * deben ir diligenciados');                
        }
        else{
            document.getElementsByName("installform").submit();//enviar los datos por submit
        }        
    }
}