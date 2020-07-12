<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Facturatech\Credenciales;
use App\Facturatech\DownloadPDFFileSend;

use Artisaninweb\SoapWrapper\SoapWrapper;

use SoapClient;
use SoapHeader;
use ChannelAdvisorAuth;

class Facturatech extends Controller
{
    protected $soapWrapper;

    public function __construct(SoapWrapper $soapWrapper)
    {
      $this->soapWrapper = $soapWrapper;
    }

    
    public function crearCredencial(Request $request){
        $credencial = new Credenciales();
        $credencial->usuario                = $request->usuario;
        $credencial->passwordWsIntegrador   = $request->passwordWsIntegrador;
        $credencial->numeroResolucion       = $request->numeroResolucion;
        $credencial->fechaInicio            = $request->fechaInicio;
        $credencial->fechaFinal             = $request->fechaFinal;
        $credencial->prefijo                = $request->prefijo;
        $credencial->numeroDesde            = $request->numeroDesde;
        $credencial->numeroHasta            = $request->numeroHasta;
        $credencial->tipoCredencial         = $request->tipoCredencial;
        $credencial->estado                 = $request->estado;
        $credencial->referenciaPago         = $request->referenciaPago;
        $credencial->idEmpresa              = $request->idEmpresa;
        $credencial->save();
        return $credencial;
    }

    public function selectCredencial(Request $request){
        $credenciales = Credenciales::all();

        return $credenciales;
    }

    public function DownloadPDFFileSend(Request $request){
        $obj = new DownloadPDFFileSend();
        $obj->username  = $request->username;
        $obj->password  = $request->password;
        $obj->prefijo   = $request->prefijo;
        $obj->folio     = $request->folio;
        $obj->id_empresa= $request->id_empresa;
        //$obj->save();

        $client     = new SoapClient("https://ws.facturatech.co/21Pro/index.php?wsdl", array("trace" => 1, "exception" => 0));
        // Create the header
        //$auth         = new ChannelAdvisorAuth("", "");
        $header     = new SoapHeader("http://www.example.com/webservices/", "APICredentials");
        //enviar datos por soal call
        $result = $client->__soapCall("FtechAction.downloadPDFFile", array(
            'username' => $obj->username, 
            'password' => $obj->password, 
            'prefijo' => $obj->prefijo, 
            'folio' => $obj->folio
        ), NULL, $header);
        
        return json_encode($result);
      
    }
}
