<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;

use App\Directorios;
use App\Retefuentes;
use App\Ciudades;
use App\Regimenes;
use App\Usuarios;
use App\Directorio_tipos;
use App\Directorio_clases;
use App\Directorio_tipo_terceros;
use App\Clasificaciones;

use DB;
use Excel;
use PDF;

use Session;

class DirectoriosController extends Controller
{
    public function create(Request $request){
        try{
            $directorios = new Directorios();
            $directorios->nit       = (string)$request->nit;
            $directorios->digito    = (string)$request->digito;
            $directorios->razon_social= (string)$request->razon_social;
            $directorios->direccion = (string)$request->direccion;
            $directorios->correo    = (string)$request->correo;
            $directorios->telefono  = (string)$request->telefono;
            $directorios->telefono1 = (string)$request->telefono1;
            $directorios->telefono2 = (string)$request->telefono2;
            $directorios->financiacion= (double)$request->financiacion;
            $directorios->descuento = (double)$request->descuento;
            $directorios->cupo_financiero= (double)$request->cupo_financiero;
            $directorios->rete_ica  = (double)$request->rete_ica;
            $directorios->porcentaje_rete_iva= (double)$request->porcentaje_rete_iva;
            $directorios->actividad_economica= $request->actividad_economica;
            $directorios->calificacion= $request->calificacion;
            $directorios->nivel     = (string)$request->nivel;
            $directorios->zona_venta= (string)$request->zona_venta;
            $directorios->transporte= (string)$request->transporte;
            $directorios->estado    = (string)$request->estado;
            $directorios->id_retefuente= $request->id_retefuente;
            $directorios->id_ciudad = $request->id_ciudad;
            $directorios->id_regimen= $request->id_regimen;
            $directorios->id_usuario= $request->id_usuario;
            $directorios->id_directorio_tipo= $request->id_directorio_tipo;
            $directorios->id_directorio_clase= $request->id_directorio_clase;
            $directorios->id_directorio_tipo_tercero= $request->id_directorio_tipo_tercero;
            $directorios->id_empresa	 	= Session::get('id_empresa');
            $directorios->save();
            return redirect('/administrador/directorios');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            $directorios = Directorios::where('id',$request->id)->first();
            $directorios->nit       = (string)$request->nit;
            $directorios->digito    = (string)$request->digito;
            $directorios->razon_social= (string)$request->razon_social;
            $directorios->direccion = (string)$request->direccion;
            $directorios->correo    = (string)$request->correo;
            $directorios->telefono  = (string)$request->telefono;
            $directorios->telefono1 = (string)$request->telefono1;
            $directorios->telefono2 = (string)$request->telefono2;
            $directorios->financiacion= (double)$request->financiacion;
            $directorios->descuento = (double)$request->descuento;
            $directorios->cupo_financiero= (double)$request->cupo_financiero;
            $directorios->rete_ica  = (double)$request->rete_ica;
            $directorios->porcentaje_rete_iva= (double)$request->porcentaje_rete_iva;
            $directorios->actividad_economica= $request->actividad_economica;
            $directorios->calificacion= $request->calificacion;
            $directorios->nivel     = (string)$request->nivel;
            $directorios->zona_venta= (string)$request->zona_venta;
            $directorios->transporte= (string)$request->transporte;
            $directorios->estado    = (string)$request->estado;
            $directorios->id_retefuente= $request->id_retefuente;
            $directorios->id_ciudad = $request->id_ciudad;
            $directorios->id_regimen= $request->id_regimen;
            $directorios->id_usuario= $request->id_usuario;
            $directorios->id_directorio_tipo= $request->id_directorio_tipo;
            $directorios->id_directorio_clase= $request->id_directorio_clase;
            $directorios->id_directorio_tipo_tercero= $request->id_directorio_tipo_tercero;
            $directorios->id_empresa	 	= Session::get('id_empresa');
            $directorios->save();
            //regresar a la vista
            return $directorios;
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function showupdate($id){
        try{
            $directorios = Directorios::find($id);
            return view('administrador.directorios-update', ['directorios' => $directorios]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function showone($id){
        try{
            $directorios = Directorios::where('id_empresa','=',Session::get('id_empresa'))
                                    ->where('id','=',$id)->get()[0];
            return  array(
                "result"=>"success",
                "body"=>$directorios);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function delete($id){
        try{
            $directorios = Directorios::where('id_empresa','=',Session::get('id_empresa'))
                                    ->where('id','=',$id)->fisrt();
            $directorios->delete();
            return redirect('/administrador/directorios');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $directorios = Directorios::where('id_empresa','=',Session::get('id_empresa'))->get();
            return  array(
                "result"=>"success",
                "body"=>$directorios);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function index(){
        try{
            $retefuentes = Retefuentes::all();
            $ciudades = Ciudades::where('id','>',0)->orderBy('codigo','ASC')->get();
            $regimenes = Regimenes::all();
            $usuarios = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->get();
            $directorio_tipos = Directorio_tipos::all();
            $directorio_clases = Directorio_clases::all();
            $directorio_tipo_terceros = Directorio_tipo_terceros::all();
            return view('administrador.directorios', [
                //'directorios' => $directorios,
                'retefuentes' => $retefuentes,
                'ciudades' => $ciudades,
                'regimenes' => $regimenes,
                'usuarios' => $usuarios,
                'directorio_tipos' => $directorio_tipos,
                'directorio_clases' => $directorio_clases,
                'directorio_tipo_terceros' => $directorio_tipo_terceros]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function calificacion($calificacion){ //este es para castigar el cupo de endeudamiento
        if($calificacion==0){
            return 'MALO';
        }
        if($calificacion==1){
            return 'REGULAR';
        }
        if($calificacion==2){
            return 'BUENO';
        }
    }
    //buscar por cualquier input y retornar las listas de ellos
    public function search(Request $request){


        $directorios = Directorios::where('id_empresa','=',Session::get('id_empresa'))
                    ->where(function ($q) use ($request){
                        if($request->nit != ''){
                            $q->where('nit','=',$request->nit);
                        }
                        if($request->razon_social != ''){
                            $q->where('razon_social','LIKE','%'.$request->razon_social.'%');
                        }
                        if($request->correo != ''){
                            $q->where('correo','LIKE','%'.$request->correo.'%');
                        }
                        if($request->tipo == "PROVEEDOR"){
                            $q->where('id_directorio_tipo_tercero','=',1);
                        }
                        else if($request->tipo == "TERCEROS"){
                            $q->where('id_directorio_tipo_tercero','=',3);
                        }
                        else{
                            $q->where('id_directorio_tipo_tercero','=',2);
                        }
                    })
                    ->take(100)
                    ->get();

        /*if($request->nit != ''){
            $directorios = Directorios::where('nit','=',$request->nit)
                                      ->where('id_empresa','=',Session::get('id_empresa'))
                                      ->take(100)
                                      ->get();
        }
        else if($request->razon_social != ''){
            $directorios = Directorios::where('razon_social','LIKE','%'.$request->razon_social.'%')
                                      ->where('id_empresa','=',Session::get('id_empresa'))
                                      ->take(100)
                                      ->get();
        }
        else if($request->correo != ''){
            $directorios = Directorios::where('correo','LIKE','%'.$request->correo.'%')
                                      ->where('id_empresa','=',Session::get('id_empresa'))
                                      ->take(100)
                                      ->get();
        }
        else{
            $directorios = Directorios::where('nit','>','0')
                                      ->where('id_empresa','=',Session::get('id_empresa'))
                                      ->take(100)
                                      ->get();
        }*/
        foreach ($directorios as $directorio) {
            $directorio->id_regimen = Regimenes::find($directorio->id_regimen);
            $directorio->id_directorio_tipo_tercero = Directorio_tipo_terceros::find($directorio->id_directorio_tipo_tercero);
            $directorio->id_directorio_tipo = Directorio_tipos::find($directorio->id_directorio_tipo);
            $directorio->id_retefuente = Retefuentes::find($directorio->id_retefuente);
        }
        return  array(
            "result"=>"success",
            "body"=>$directorios);
    }

    public function searchText(Request $request){
        if(isset($request->nit)){
            $directorios = Directorios::where('nit','=',$request->nit)
                                      ->where('id_empresa','=',Session::get('id_empresa'))
                                      //->where('id_directorio_tipo_tercero', '=', '2')
                                      ->take(100)
                                      ->get();
        }
        else{
            $directorios = Directorios::where('razon_social','like','%'.$request->texto.'%')
                            //->where('id_directorio_tipo_tercero', '=', '2')
                            ->where('id_empresa','=',Session::get('id_empresa'))->get();
        }
        
        return  array(
            "result"=>"success",
            "body"=>$directorios);
    }

    public function addTercero(Request $request){
        $directorios = Directorios::where('id_empresa','=',Session::get('id_empresa'))
                        ->where('nit','=',$request->nit)
                        ->first();
        if(sizeof($directorios) == 0){
            $directorios = new Directorios();
            $directorios->nit       = $request->nit;
            $directorios->id_ciudad = $request->id_ciudad;
            $directorios->razon_social= $request->razon_social;
            $directorios->direccion = $request->direccion;
            $directorios->correo    = $request->correo;
            $directorios->telefono  = $request->telefono;
            $directorios->telefono1 = $request->telefono;
            $directorios->telefono2 = $request->telefono;
            $directorios->digito    = "0";
            $directorios->financiacion= "0";
            $directorios->descuento = "0";
            $directorios->cupo_financiero= "0";
            $directorios->rete_ica  = "0";
            $directorios->porcentaje_rete_iva= "0";
            $directorios->actividad_economica= "0";
            $directorios->calificacion= "2";
            $directorios->nivel     = "NACIONAL";
            $directorios->zona_venta= $request->zona_venta;
            $directorios->transporte= "NO";
            $directorios->estado    = "1";
            $directorios->id_retefuente= "1";
            $directorios->id_regimen= "1";
            $directorios->id_usuario= "1";
            $directorios->id_directorio_tipo= "1";
            $directorios->id_directorio_clase= "1";
        }
        else{
            $directorios->nit       = $request->nit;
            $directorios->id_ciudad = $request->id_ciudad;
            $directorios->razon_social= $request->razon_social;
            $directorios->direccion = $request->direccion;
            $directorios->correo    = $request->correo;
            $directorios->telefono  = $request->telefono;
            $directorios->telefono1 = $request->telefono;
            $directorios->telefono2 = $request->telefono;
            $directorios->zona_venta= $request->zona_venta;
        }
        
        if(isset($request->id_directorio_tipo_tercero)){
            $directorios->id_directorio_tipo_tercero= $request->id_directorio_tipo_tercero;
        }
        else{
            $directorios->id_directorio_tipo_tercero= "3";
        }
        $directorios->id_empresa	 	= Session::get('id_empresa');
        $directorios->save();

        return array(
            "result"=>"success",
            "body"=>$directorios
        );
    }

    /**
     * Excel Reporte
     */
    public function excel(Request $request){
        
		
		$objs = DB::select("
        select nit, digito, razon_social, direccion, ciudades.nombre AS id_ciudad, telefono, correo,
         telefono1, telefono2, calificacion, retefuentes.nombre AS id_retefuente, regimenes.nombre AS id_regimen, 
         directorio_tipo_terceros.nombre AS id_directorio_tipo_tercero, directorio_clases.nombre AS id_directorio_clase, estado 
         from directorios  
         INNER JOIN directorio_clases ON directorios.id_directorio_clase = directorio_clases.id 
         INNER JOIN directorio_tipo_terceros ON directorios.id_directorio_tipo_tercero = directorio_tipo_terceros.id 
         INNER JOIN regimenes ON directorios.id_regimen = regimenes.id 
         INNER JOIN ciudades ON directorios.id_ciudad = ciudades.id 
         INNER JOIN retefuentes ON directorios.id_retefuente = retefuentes.id 
         where id_empresa = ".Session::get('id_empresa')." 
         OR id_regimen = ".$request->id_regimen." 
         OR id_ciudad = ".$request->id_ciudad." 
         OR id_retefuente = ".$request->id_retefuente." 
         OR estado like '".$request->estado."' 
         OR nivel like '".$request->nivel."' 
         OR `calificacion` like '".$request->clasificacion."'
         OR id_directorio_tipo_tercero = ".$request->id_directorio_tipo_tercero."  ");
		$objs= Collection::make($objs);
			
        
        $data= json_decode( json_encode($objs), true);

        Excel::create('Directorio', function($excel) use($data) {
            $excel->sheet('directorio', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('xls');
    }

    /**
     * PDF reportes
     */
    public function pdf(Request $request){
		
		$objs = DB::select("
        select nit, digito, razon_social, direccion, ciudades.nombre AS id_ciudad, telefono, correo,
         telefono1, telefono2, calificacion, retefuentes.nombre AS id_retefuente, regimenes.nombre AS id_regimen, 
         directorio_tipo_terceros.nombre AS id_directorio_tipo_tercero, directorio_clases.nombre AS id_directorio_clase, estado 
         from directorios 
         INNER JOIN directorio_clases ON directorios.id_directorio_clase = directorio_clases.id 
         INNER JOIN directorio_tipo_terceros ON directorios.id_directorio_tipo_tercero = directorio_tipo_terceros.id 
         INNER JOIN regimenes ON directorios.id_regimen = regimenes.id 
         INNER JOIN ciudades ON directorios.id_ciudad = ciudades.id 
         INNER JOIN retefuentes ON directorios.id_retefuente = retefuentes.id 
         where id_empresa = ".Session::get('id_empresa')." 
         OR id_regimen = ".$request->id_regimen." 
         OR id_ciudad = ".$request->id_ciudad." 
         OR id_retefuente = ".$request->id_retefuente." 
         OR estado like '".$request->estado."' 
         OR nivel like '".$request->nivel."' 
         OR `calificacion` like '".$request->clasificacion."'
         OR id_directorio_tipo_tercero = ".$request->id_directorio_tipo_tercero."  ");
		$objs= Collection::make($objs);
		
        
        $data= json_decode( json_encode($objs), true);

        $pdf = PDF::loadView('pdfs.pdfDirectorio', compact('data'));
        return $pdf->download('Directorio.pdf');
    }


    //INTERGRACION INTERCON
    public function subirTercero(Request $request){
        //GUARDAR ARCHIVO EN EL STORAGE
        //obtenemos el campo file definido en el formulario
        $file = $request->file('file');
        //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();
        //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('local')->put($nombre,  \File::get($file));

        //RECORRER EL ARCHIVO EN EL STORAGE
        $public_path = public_path();
        $url = $public_path.'/storage/'.$nombre;
        //verificamos si el archivo existe y lo retornamos
        if (\Storage::exists($nombre))
        {
            $numlinea = 0;
            $archivo = fopen($url,'r');
            //recorrer cada linea
            while ($linea = fgets($archivo)) {
                $lineas[] = str_replace("  ","",explode(';',$linea)); 
                $numlinea++;
            }
            fclose($archivo);
        }

        //dd($lineas);
 
        return view('administrador.integracion',[
            "terceros"=>$lineas
        ]);
    }

    public function saveTercero(Request $request){

        try{

            $tercero = Directorios::where('id_empresa','=',Session::get('id_empresa'))
                ->where('nit','=',$request->nit)
                ->get();
            if(sizeof($tercero)>0){
                return array(
                    "result" => "Existe",
                    "body" => "El Tercero ya existe en la base de datos"
                );
            }

            $directorios = new Directorios();
            $directorios->nit       = (string)$request->nit;
            $directorios->digito    = (string)$request->digito;
            $directorios->razon_social= (string)$request->razon_social;
            $directorios->direccion = (string)$request->direccion;
            $directorios->correo    = (string)$request->correo;
            $directorios->telefono  = (string)$request->telefono;
            $directorios->telefono1 = (string)$request->telefono1;
            $directorios->telefono2 = (string)$request->telefono2;
            $directorios->financiacion= (double)$request->financiacion;
            $directorios->descuento = (double)$request->descuento;
            $directorios->cupo_financiero= (double)$request->cupo_financiero;
            $directorios->rete_ica  = (double)$request->rete_ica;
            $directorios->porcentaje_rete_iva= (double)$request->porcentaje_rete_iva;
            $directorios->actividad_economica= $request->actividad_economica;
            $directorios->zona_venta= (string)$request->zona_venta;
            $directorios->id_empresa	 	= Session::get('id_empresa');
            $directorios->calificacion= $request->calificacion;
            $directorios->transporte= (string)$request->transporte;
            $directorios->id_directorio_clase= $request->id_directorio_clase;

            if($request->id_directorio_tipo_tercero == "CLIENTE"){
                $directorios->id_directorio_tipo_tercero= 2;
            }
            else if($request->id_directorio_tipo_tercero == "PROVEEDOR"){
                $directorios->id_directorio_tipo_tercero= 1;
            }
            else{
                $directorios->id_directorio_tipo_tercero= 3;
            }

            if($request->digito!="" || $request->digito != " "){
                $directorios->id_directorio_tipo= 2; //JURIDICA
            }
            else{
                $directorios->id_directorio_tipo= 1;//NATURAL
            }
            $vendedor = Usuarios::where('id_empresa','=',Session::get('id_empresa'))->where('ncedula','=',$request->id_usuario)->get();
            if(sizeof($vendedor)==0){
                return array(
                    "result" => "Incorrecto",
                    "body" => "El Vendedor no existe "
                );
            }
            $directorios->id_usuario= $vendedor[0]->id;

            if($request->estado == "I"){
                $directorios->estado    = "INACTIVO";
            }
            else{
                $directorios->estado    = "ACTIVO";
            }

            if($request->nivel == "NACIO"){
                $directorios->nivel     = "NACIONAL";
            }
            else{
                $directorios->nivel     = "INTERNACIONAL";
            }
            
            if($request->id_regimen == "SIMPL"){
                $directorios->id_regimen= 1; //Régimen Único Simplificado
            }
            else{
                $directorios->id_regimen= 2; //Régimen Común
            }
            
            if($request->id_retefuente == "T"){
                $directorios->id_retefuente= 1; //SOBRE TODO
            }
            else if($request->id_retefuente == "B"){
                $directorios->id_retefuente= 2; //SOBRE LA BASE MENSUAL
            }
            else{
                $directorios->id_retefuente= 3; //NO PRESENTA
            }
            
            $ciudades = Ciudades::where('codigo','=',$request->id_ciudad)->get();
            if(sizeof($ciudades)==0){
                return array(
                    "result" => "Incorrecto",
                    "body" => "La ciudades no existe "
                );
            }
            $directorios->id_ciudad = $ciudades[0]->id;

            $directorios->save();
            
            return array(
                "result" => "Correcto",
                "body" => "El Tercero fue registrado"
            );
        }
        catch(Exception $exce){
            return array(
                "result" => "Incorrecto",
                "body" => $exce
            );
        }
    }
}
