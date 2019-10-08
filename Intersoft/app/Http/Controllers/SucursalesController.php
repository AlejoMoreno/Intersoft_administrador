<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sucursales;
use App\Empresas;
use App\Ciudades;
use Excel;
use PDF;

use Session;

class SucursalesController extends Controller
{
    public function create(Request $request){
        
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

        //crear la cuenta correspondiente
        $cuenta = new Cuentas();
        $cuenta->clase          = '1';
        $cuenta->nombreClase    = 'ACTIVO';
        $cuenta->grupo          = '11';
        $cuenta->nombreGrupo    = 'DISPONIBLE';
        $cuenta->cuenta         = '05';
        $cuenta->nombreCuenta   = 'CAJA';
        $cuenta->subcuenta      = '05';
        $cuenta->nombreSubcuenta = 'CAJA GENERAL';
        $cuenta->auxiliar       = $Sucursales->id;
        $cuenta->nombreAuxiliar = $sucursales->nombre;
        $cuenta->homologo       = '0';
        $cuenta->homologo_1     = '0';
        $cuenta->save();

        return redirect('/administrador/sucursales');
    }

    public function update(Request $request){
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
    
    public function showone($id){
        $sucursales = Sucursales::find($id);
        return  array(
            "result"=>"success",
            "body"=>$sucursales);
    }

    public function delete($id){
        $sucursales = Sucursales::find($id);
        $sucursales->delete();
        return redirect('/administrador/sucursales');
    }

    public function all(){
        $sucursales = Sucursales::all();
        return  array(
            "result"=>"success",
            "body"=>$sucursales);
    }

    public function index(){
        $sucursales = Sucursales::all();
        foreach( $sucursales as $sucursal ){
            $sucursal->ciudad = Ciudades::find($sucursal->ciudad);
        }
        $empresas = Empresas::find(1);
        $ciudades = Ciudades::all();
        return view('administrador.sucursales', [
            'sucursales' => $sucursales, 
            'empresas' => $empresas,
            'ciudades' => $ciudades]);
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
