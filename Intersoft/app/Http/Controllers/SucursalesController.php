<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sucursales;
use App\Empresas;
use App\Ciudades;
use Excel;
use PDF;

use DB;

use Session;

class SucursalesController extends Controller
{
    public function create(Request $request){
        try{
            $sucursales = new Sucursales();
            $sucursales->nombre     = $request->nombre;
            $sucursales->codigo     = $request->codigo;
            $sucursales->direccion  = $request->direccion;
            $sucursales->encargado  = $request->encargado;
            $sucursales->telefono   = $request->telefono;
            $sucursales->correo     = $request->correo;
            $sucursales->ciudad     = $request->ciudad;
            $sucursales->id_empresa = Session::get('id_empresa');
            $sucursales->save();

            return redirect('/administrador/sucursales');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            $sucursal = Sucursales::where('id',$request->id)->first();
            $sucursal->nombre     = $request->nombre;
            $sucursal->codigo     = $request->codigo;
            $sucursal->direccion  = $request->direccion;
            $sucursal->encargado  = $request->encargado;
            $sucursal->telefono   = $request->telefono;
            $sucursal->correo     = $request->correo;
            $sucursal->ciudad     = $request->ciudad;
            $sucursal->id_empresa = Session::get('id_empresa');
            $sucursal->save();
            return $sucursal;
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }
    
    public function showone($id){
        try{
            $sucursales = Sucursales::where('id_empresa','=',Session::get('id_empresa'))
                                    ->where('id','=',$id)->fisrt(); 
            return  array(
                "result"=>"success",
                "body"=>$sucursales);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function delete($id){
        try{
            $sucursales = Sucursales::where('id_empresa','=',Session::get('id_empresa'))
                                    ->where('id','=',$id)->fisrt();
            $sucursales->delete();
            return redirect('/administrador/sucursales');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $sucursales = Sucursales::where('id_empresa','=',Session::get('id_empresa'))->get();
            return  array(
                "result"=>"success",
                "body"=>$sucursales);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function index(){
        try{
            $sucursales = Sucursales::where('id_empresa','=',Session::get('id_empresa'))->get();
            foreach( $sucursales as $sucursal ){
                $sucursal->ciudad = Ciudades::find($sucursal->ciudad);
            }
            $empresas = Empresas::find(Session::get('id_empresa'));
            $ciudades = Ciudades::all();
            return view('administrador.sucursales', [
                'sucursales' => $sucursales, 
                'empresas' => $empresas,
                'ciudades' => $ciudades]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function chartPie(){
        $result = \DB::table('facturas')
                    ->select('id_sucursal','id_documento', DB::raw('SUM(total) as total'))
                    ->where('id_empresa',Session::get('id_empresa'))
                    ->where('estado','=','ACTIVO')
                    ->groupBy('id_sucursal','id_documento')
                    ->get();
        foreach($result as $obj){
            $obj->id_documento = \App\Documentos::where('id',$obj->id_documento)->first();
        }
        
        return response()->json($result);
    }

    public function excel_all(){
        $sucursales = Sucursales::select('id', 'nombre', 'codigo', 'direccion', 'encargado', 'created_at')->get();
        Excel::create('sucursales', function($excel) use($sucursales) {
            $excel->sheet('Sheet 1', function($sheet) use($sucursales) {
                $sheet->fromArray($sucursales);
            });
        })->export('xls');
    }

    public function pdf_all(){
        $sucursales = Sucursales::select('id', 'nombre', 'codigo', 'direccion', 'encargado', 'ciudad', 'created_at')->get();
        foreach( $sucursales as $sucursal ){
            $sucursal->ciudad = Ciudades::find($sucursal->ciudad);
        }
        $pdf = PDF::loadView('pdfs.pdfSucursales', compact('sucursales'));
        return $pdf->download('invoice.pdf');
    }
}
