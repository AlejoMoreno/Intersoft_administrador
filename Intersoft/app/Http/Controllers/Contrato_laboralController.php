<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contrato_laborals;
use Excel;
use PDF;

use Session;

class Contrato_laboralController extends Controller
{
    public function create(Request $request){
        try{
            $contrato_laborales = new Contrato_laborals();
            $contrato_laborales->tipo_contrato  = $request->tipo_contrato;
            $contrato_laborales->descripcion    = $request->descripcion;
            $contrato_laborales->consecutivo    = $request->consecutivo;
            $contrato_laborales->fecha_inicial  = $request->fecha_inicial;
            $contrato_laborales->fecha_final    = $request->fecha_final;
            $contrato_laborales->id_empresa    = Session::get('id_empresa');
            $contrato_laborales->save();
            return redirect('/administrador/contratos');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function update(Request $request){
        try{
            $contrato_laborales = Contrato_laborals::where('id',$request->id)->first();
            $contrato_laborales->tipo_contrato  = $request->tipo_contrato;
            $contrato_laborales->descripcion    = $request->descripcion;
            $contrato_laborales->consecutivo    = $request->consecutivo;
            $contrato_laborales->fecha_inicial  = $request->fecha_inicial;
            $contrato_laborales->fecha_final    = $request->fecha_final;
            $contrato_laborales->id_empresa    = Session::get('id_empresa');
            $contrato_laborales->save();
            return $contrato_laborales;
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function showupdate($id){
        try{
            $contrato_laborales = Contrato_laborals::where('id_empresa','=',Session::get('id_empresa'))
                                                ->where('id','=',$id)->fisrt();
            return  array(
                "result"=>"success",
                "body"=>$contrato_laborales);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function delete($id){
        try{
            $contrato_laborales = Contrato_laborals::where('id_empresa','=',Session::get('id_empresa'))
                                                ->where('id','=',$id)->fisrt();
            $contrato_laborales->delete();
            return redirect('/administrador/contratos');
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function all(){
        try{
            $contrato_laborales = Contrato_laborals::where('id_empresa','=',Session::get('id_empresa'))->get();   
            return  array(
                "result"=>"success",
                "body"=>$contrato_laborales);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function index(){
        try{
            $contrato_laborales = Contrato_laborals::where('id_empresa','=',Session::get('id_empresa'))->get();
            return view('administrador.contratos', ['contrato_laborales' => $contrato_laborales]);
        }
        catch (ModelNotFoundException $exception){
            return  array(
                "result"=>"fail",
                "body"=>$exception);
        }
    }

    public function excel_all(){
        $obj = Contrato_laborals::select('id', 'tipo_contrato', 'descripcion', 'consecutivo', 'fecha_inicial', 'fecha_final')->get();
        Excel::create('obj', function($excel) use($obj) {
            $excel->sheet('Sheet 1', function($sheet) use($obj) {
                $sheet->fromArray($obj);
            });
        })->export('xls');
    }

    public function pdf_all(){
        $obj = Contrato_laborals::select('id', 'tipo_contrato', 'descripcion', 'consecutivo', 'fecha_inicial', 'fecha_final')->get();
        $pdf = PDF::loadView('pdfs.pdfContrato_laboral', compact('obj'));
        return $pdf->download('invoice.pdf');
    }

}
