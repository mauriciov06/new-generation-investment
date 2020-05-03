<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReferidoCreateRequest;
use App\Http\Requests\ReferidoUpdateRequest;

use App\Pais;
use App\User;
use App\Paquete;
use App\Contrato;
use App\Finanzas;
use App\ReferidosContratos;
use App\ContratosLegales;

use Auth;
use Redirect;
use Session;
use DB;
use App\Http\Requests;
use Carbon\Carbon;
use Mail;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listconfipago = ReferidosContratos::busquedausuario($request->get('codigo_r'))->orderBy('id_referidos_contratos','DESC')->paginate(10);
        return view('cuenta.forms.listado-confirmaciones-pagos', compact('listconfipago'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $paises = Pais::pluck('nombre_pais','id_pais');
        $contratos = ReferidosContratos::where('referidos_contratos.id_user', $id)
                            ->select('referidos_contratos.id_referidos_contratos','referidos_contratos.id_user','referidos_contratos.id_contrato','referidos_contratos.id_paquete', 'referidos_contratos.estado_referido_contratos','referidos_contratos.valor_inversion')
                            ->orderby('referidos_contratos.id_contrato', 'ASC')
                            ->get();

        return view('cuenta.edit', ['usuario'=>$usuario, 'paises'=>$paises, 'contratos'=>$contratos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReferidoUpdateRequest $request, $id)
    {
        $usuario = User::find($id);
        $usuario->fill($request->all());
        $usuario->save();

        return redirect('/cuenta/'.$id.'/edit')->with('message','Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function confirmarPago(Request $request){

      $hashPagoExis = ReferidosContratos::where('hash_pago',$request->hashPago)
                                          ->get();
      $usuario = User::find($request->idUser);

      $emailsAdmin = User::where('id_tipo_cuenta', 1)
                                    ->select('email')
                                    ->get();

      $arrayEmails = [];
      foreach ($emailsAdmin as $emails) {
        $arrayEmails[] = $emails->email;
      }

      if(!isset($hashPagoExis[0])){
        if($request->ajax()){
          $confirmacionPago = new ReferidosContratos;
          $confirmacionPago->id_user = $request->idUser;
          $confirmacionPago->id_contrato = $request->idContrato;
          $confirmacionPago->id_paquete = 0;
          $confirmacionPago->hash_pago = $request->hashPago;
          $confirmacionPago->valor_inversion = $request->valorInversion;

          $fechaSoliConfi = date("Y-m-d H:i:s");
          $confirmacionPago->datetime_solicitud = $fechaSoliConfi;
          $confirmacionPago->datetime_solicitud_temp = date("Y-m-d H:i:s",strtotime($fechaSoliConfi."+ 8 hour"));
          if($confirmacionPago->save()){
            
            Mail::send('template-correos.confirmar-pago', ['valorInversion'=>$request->valorInversion,'idContrato'=>$request->idContrato,'usuario'=>$usuario, 'hashPago'=>$request->hashPago], function($msj) use ($usuario,$arrayEmails){
              $msj->subject('Codigo de Referido: '.$usuario->codigo_referido_users.' - Confirmación de Pago');
              $msj->to($arrayEmails);
            });

            return response()->json([
              'envio' => true,
              'mensaje' => 'Confirmación exitosamente, los contratos inactivos sean activados 12 horas despues de la confirmación del pago'
            ]);
          }
        }else{
          return response()->json([
                'envio' => false
          ]);
        }
      }else{
        return response()->json([
              'envio' => false,
              'mensaje' => 'El hash de pago ya se encuentra registrado.'
        ]);
      }
    }

    static function countConfirmacionesPago(){
        $confPago = ReferidosContratos::get();
        return count($confPago);
    }

    static function infoUsuario($idUsuario){
        $infoUser = User::where('id_user', $idUsuario)->select('name','email','codigo_referido_users','direccion_billetera')->first();
        return $infoUser;
    }
    
    static function infoContrato($idContrato){
        $infoContrato = Contrato::where('id_contrato', $idContrato)->first();
        return $infoContrato->nombre_contrato;
    }
    
    static function infoPaquete($idPaquete){
        $infoPaquete = Paquete::where('id_paquete', $idPaquete)->first();
        return $infoPaquete->nombre_paquete;
    }

    static function valorPaquete($idPaquete){
        $infoPaquete = Paquete::where('id_paquete', $idPaquete)->first();
        return $infoPaquete->valor_paquete;
    }

    public function validarRetiro(Request $request){
      if($request->ajax()){
        //dd($request->iduser, $request->valorRetiro);
        $userInfo = Finanzas::where('id_user', $request->iduser)
                             ->select('valor_utilidad')
                             ->get();
        dd($userInfo);
        return response()->json([
            'verificado' => true,
            'mensaje' => 'Se ha confirmado correctamente el valor de su retiro.'
        ]);
      }else{
          return response()->json([
            'verificado' => false
        ]);
      }
    }

    public function cambioEstadoConfiPag(Request $request){
        if($request->ajax()){
            $confirmacionPago = ReferidosContratos::find($request->idConfigPago);
            $confirmacionPago->estado_referido_contratos = $request->estadoUpdate;

            $fechaAA = date("Y-m-d H:i:s");
            $fechaExpiracionCont = "";

            if($confirmacionPago->id_contrato == 1){
                $fechaExpiracionCont = "+ 3 months";
            }elseif($confirmacionPago->id_contrato == 2){
                $fechaExpiracionCont = "+ 6 months";
            }else{
                $fechaExpiracionCont = "+ 12 months";
            }       

            $confirmacionPago->datatime_activacion = $fechaAA;
            $confirmacionPago->datatime_vencimiento = date("Y-m-d H:i:s",strtotime($fechaAA.$fechaExpiracionCont));
            $confirmacionPago->update();

            return response()->json([
                'envio' => true
            ]);
        }else{
            return response()->json([
                'envio' => false
          ]);
        }
    }

    // public function validacionContrato($idUsuario, $idContrato)
    // {
    //     $contratos = ReferidosContratos::where('id_user', $idUsuario)
    //                   ->where('id_contrato', $idContrato)
    //                   ->get();
    //     return count($contratos);
    // }


    public function detallesCuenta($id)
    {
        $usuario = User::find($id);        
        $referidoDirecto = User::where('id_tipo_cuenta',2)
                            ->where('codigo_referido_users', $usuario->codigo_referido_padre_users)
                            ->select('name','celular_users','codigo_referido_users', 'id_pais')
                            ->get();

        return view('cuenta.forms.datos-cuenta', compact('usuario','referidoDirecto'));
    }

    public function activarContratos()
    {
        $contratos = Contrato::get();
        $paquetes = Paquete::get();

        return view('cuenta.forms.activar-contrato', compact('contratos','paquetes'));
    }

    public function misContratos($id)
    {
                               
      $listadoContratos = ReferidosContratos::where('referidos_contratos.id_user', $id)
                            ->select('referidos_contratos.id_referidos_contratos','referidos_contratos.id_user','referidos_contratos.id_contrato','referidos_contratos.id_paquete', 'referidos_contratos.estado_referido_contratos','referidos_contratos.valor_inversion')
                            ->orderby('referidos_contratos.id_contrato', 'ASC')
                            ->get();
      
      return view('cuenta.forms.mis-contratos', compact('listadoContratos'));
    }

    public function firmaContrato(Request $request){
      if($request->ajax()){
          $firmaContrato = new ContratosLegales;
          $firmaContrato->nombre_completo = $request->nombreCompleto;
          $firmaContrato->numero_documento = $request->numDocu;
          $firmaContrato->id_usuario = $request->idUser;

          if($firmaContrato->save()){
            return response()->json([
                'idFirma' => $firmaContrato->id_contrato_legal,
                'envio' => true,
                'mensaje' => 'Gracias por aceptar nuestros termino y condiciones, continua con tu inversión.'
            ]);
          }else{
            return response()->json([
              'envio' => false,
              'mensaje' => 'No se ha podido guardar la aceptación del contacto, actualice e intente de nuevo.'
            ]);
          }
      }else{
        return response()->json([
              'envio' => false,
              'mensaje' => 'No se ha podido terminar el proceso de aceptación del contacto'
        ]);
      }
    }

    static function formatDate($date){
        $fechaParse = Carbon::parse($date);
        return $fechaParse->format('d/m/Y \\a \\l\\a\\s h:i A');
    }

    static function infoFinanzas($idUser,$idRefeCon){
      $infoFinanzas = Finanzas::where('id_user', $idUser)
                  ->where('id_referidos_contratos', $idRefeCon)
                  ->first();
      if($infoFinanzas != null){
        return $infoFinanzas->id_finanza;
      }else{
        return null;
      }
    }



}
