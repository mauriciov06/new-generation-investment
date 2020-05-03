<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Paquete;
use App\Contrato;
use App\Finanzas;
use App\Retiros;
use App\ReferidosContratos;
use App\UpgradeContrato;
use Auth;

use Carbon\Carbon;
use Carbon\CarbonImmutable;

class FinanzasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizarFechaRefContra()
    {
        
        //Verificamos que las confirmaciones de pago no tenga estas fecha en null, ya que al generar la confirmacion se debe generar los campos $datetime_solicitud y $datetime_solicitud_temp esto solo aplica para registros que en su inicio no guardaban estas fecha.
        $refsContrNull = ReferidosContratos::where('datetime_solicitud',null)
                            ->where('datetime_solicitud_temp',null)->get();

        if(isset($refsContrNull[0])){
            foreach ($refsContrNull as $key => $refContrNull) {
                $updateFechaContr = ReferidosContratos::find($refContrNull->id_referidos_contratos);

                if($refContrNull->estado_referido_contratos == 1){
                    $fechaActivacion = date("Y-m-d H:i:s",strtotime($refContrNull->created_at."+ 1 day"));

                    if($refContrNull->id_contrato == 1){
                        $fechaExpiracionCont = "+ 28 days";
                    }elseif($refContrNull->id_contrato == 2){
                        $fechaExpiracionCont = "+ 56 days";
                    }elseif($refContrNull->id_contrato == 3){
                        $fechaExpiracionCont = "+ 84 days";
                    }else{
                        $fechaExpiracionCont = "+ 168 days";
                    }

                    $fechaVencimiento = date("Y-m-d H:i:s",strtotime($fechaActivacion.$fechaExpiracionCont));

                    $updateFechaContr->datatime_activacion = $fechaActivacion;
                    $updateFechaContr->datatime_vencimiento = $fechaVencimiento;
                }

                $fechaSolicitud = $refContrNull->created_at;
                $fechaSolicitudTemp = date("Y-m-d H:i:s",strtotime($fechaSolicitud."+ 8 hour"));

                $updateFechaContr->datetime_solicitud = $fechaSolicitud;
                $updateFechaContr->datetime_solicitud_temp = $fechaSolicitudTemp;
                $updateFechaContr->save();
                
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function balance()
    {
        $en = CarbonImmutable::now()->locale('es');

        if($en->dayOfWeek != 0 || $en->dayOfWeek != 6){


            $idUser = Auth::user()->id_user;
            $refsConUsers = ReferidosContratos::where('referidos_contratos.id_user', $idUser)
                              ->where('referidos_contratos.estado_referido_contratos', 1)
                              ->get();
            $infoBalanace = array();
            
            if(isset($refsConUsers[0])){

                //$hoy = date("2019-12-02");
                $hoy = date("Y-m-d");
                $hoyUnix = strtotime($hoy);
                $gt = $eq = $lt = false;

                foreach ($refsConUsers as $key => $refsConUser) {
                  //Consultamos el registro de finanza para un usuario en especifico y calculamos su saldo.
                  $finanzaUsers = Finanzas::where('id_user',$idUser)
                                            ->where('id_contrato', $refsConUser->id_contrato)
                                            ->where('id_referidos_contratos', $refsConUser->id_referidos_contratos)
                                            ->get();

                  $dteVencUnix = strtotime(date("Y-m-d", strtotime($refsConUser->datatime_vencimiento)));
                  $dteActiUnix = strtotime(date("Y-m-d", strtotime($refsConUser->datatime_activacion)));
                  
                  //dd($hoyUnix, $dteVencUnix, $dteActiUnix);

                  //La fecha actual es mayor a la de vencimiento
                  if($hoyUnix > $dteVencUnix){
                      $gt = true;
                  }

                  //La fecha actual es igual a la de vencimiento
                  if($hoyUnix == $dteVencUnix){
                      $eq = true;
                  }

                  //La fecha actual es menor a la fecha de activacion
                  if($hoyUnix < $dteActiUnix){
                      $lt = true;
                  }
                    
                  if(!$lt){
                      
                    if(!isset($finanzaUsers[0])){
                      $inversion = $refsConUser->valor_inversion; 

                      $tempRestult = self::calculoValorDiarioCon($refsConUser->id_contrato, $inversion);
                      
                      $valorDiario = $tempRestult['valorDiario'];

                      $finanza = new Finanzas;
                      $finanza->id_user = $idUser;
                      $finanza->id_contrato = $refsConUser->id_contrato;
                      $finanza->valor_utilidad = $valorDiario;
                      $finanza->ganancia_diaria = $tempRestult['gananciaDiaria'];
                      $finanza->valor_diario = $valorDiario;
                      $finanza->id_referidos_contratos = $refsConUser->id_referidos_contratos;
                      $finanza->save();
                    }else{
                      foreach ($finanzaUsers as $key => $finanzaUser) {
                        $fechaActual = date("Y-m-d");
                        //$fechaActual = date("2019-12-10");
                        $fechaActuMA = date("Y-m");

                        //prueba-inicio

                        // //$es = CarbonImmutable::now()->locale('es_ES');
                        // $es = Carbon::parse($fechaActual)->locale('es_ES');

                        // $start = $es->startOfWeek(Carbon::MONDAY);
                        // $end = $es->endOfWeek(Carbon::FRIDAY);
                        // dd($es, $start, $end);
                        //prueba-fin

                        $fechaActivacion = Carbon::parse($refsConUser->datatime_activacion)->format('Y-m-d');
                        $fechaActMA = Carbon::parse($refsConUser->datatime_activacion)->format('Y-m');

                        $diasHabiles = self::bussiness_days($fechaActivacion, $fechaActual);
                        
                        $finanza = Finanzas::find($finanzaUser->id_finanza);
                        
                        if($diasHabiles != false){
                            if(count($diasHabiles) > 1){
                              $diastotalesHbi = count($diasHabiles[$fechaActMA])+count($diasHabiles[$fechaActuMA]);
                            }else{
                                
                                if(isset($diasHabiles[$fechaActMA])){
                                    $diastotalesHbi = count($diasHabiles[$fechaActMA]);
                                }else{
                                    $fechaActMA = Carbon::parse($refsConUser->datatime_activacion)->addMonth()->format('Y-m');
                                    
                                    $diastotalesHbi = count($diasHabiles[$fechaActMA]);
                                    
                                }
                                
                            }
                        }else{
                            $diastotalesHbi = 1;
                        }
                        

                        //Consultamos si existen retiros para esa finanza
                        $retiros = Retiros::where('id_finanza', $finanzaUser->id_finanza)
                                             ->where('estado_retiro',1)
                                             ->where('fecha_confi_retiro',null)
                                             ->get();

                        //Validamos si existen retiros para esa finanza
                        if(isset($retiros[0])){
                          $sumaRetiros = 0;

                          foreach ($retiros as $retiro) {
                            $sumaRetiros += $retiro->valor_retirar; 
                            if($retiro->id_user == $finanzaUser->id_user){
                              $finanza->valor_utilidad = ($finanza->valor_utilidad-$sumaRetiros);

                              $retiroUpdate = Retiros::find($retiro->id_retiros);
                              $retiroUpdate->fecha_confi_retiro = date("Y-m-d");
                              $retiroUpdate->update();
                            }
                          }
                        }else{
                            
                            $retirosConfi = Retiros::where('id_finanza', $finanzaUser->id_finanza)
                                             ->where('estado_retiro',1)
                                             ->whereNotNull('fecha_confi_retiro')
                                             ->get();
                            
                            if(isset($retirosConfi[0])){
                                $sumaRetiros = 0;

                                foreach ($retirosConfi as $retiroconfi) {
                                    $sumaRetiros += $retiroconfi->valor_retirar; 
                                    if($retiroconfi->id_user == $finanzaUser->id_user){
                                        if($finanza->estado_finanza != 1){
                                            $valorUtilidad = (($diastotalesHbi*$finanza->valor_diario)-$sumaRetiros);
                                            $finanza->valor_utilidad = $valorUtilidad;
                                        }
                                    }
                                }
                              
                            }else{

                                if($finanza->estado_finanza != 1){
                                    $valorUtilidad = (($diastotalesHbi*$finanza->valor_diario));
                                    $finanza->valor_utilidad = $valorUtilidad;
                                }
                            }
                            
                           
                        }
                      }
                    }
                    if($gt || $eq){
                        $finanza->estado_finanza = 1;
                    }
                    $finanza->save();
                  }

                  $infoBalanace[] = $finanzaUsers;
                }
                
            }
        }
        return view('finanzas.balance.index', compact('infoBalanace'));
        
    }

    static function bussiness_days($begin_date, $end_date, $type = 'array') {
      $date_1 = date_create($begin_date);
      $date_1 = date_add($date_1, date_interval_create_from_date_string("1 day"));
      $date_2 = date_create($end_date);
      if ($date_1 > $date_2) return false;
      $bussiness_days = array();
      while ($date_1 <= $date_2) {
        $day_week = $date_1->format('w');
        if ($day_week > 0 && $day_week < 6) {
          $bussiness_days[$date_1->format('Y-m')][] = $date_1->format('d');
        }
        date_add($date_1, date_interval_create_from_date_string('1 day'));
      }
      if (strtolower($type) === 'sum') {
          array_map(function($k) use(&$bussiness_days) {
              $bussiness_days[$k] = count($bussiness_days[$k]);
          }, array_keys($bussiness_days));
      }
      return $bussiness_days;
    }

    static function redondearValor($valor){
        $float_redondeado=round($valor * 100) / 100;
        return $float_redondeado;
    }

    static function dias_transcurridos($fecha_i,$fecha_f){
        $dias   = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
        $dias   = abs($dias); $dias = floor($dias);     
        return $dias;
    }

    static function fechaActivacionContrato($idRefCon){
        $fechaContrato = ReferidosContratos::find($idRefCon);
        
        if(isset($fechaContrato)){
            $fechaParse = Carbon::parse($fechaContrato->datatime_activacion);
            return $fechaParse->format('d/m/y');
        }else{
            return 'Fecha de activación no encontrada';
        }
    }

    static function fechaVencimientoContrato($idRefCon){
        $fechaContrato = ReferidosContratos::find($idRefCon);
        
        if(isset($fechaContrato)){
            $fechaParse = Carbon::parse($fechaContrato->datatime_vencimiento);
            return $fechaParse->format('d/m/y');
        }else{
            return 'Fecha de vencimiento no encontrada';
        }
    }

    static function calculoValorDiarioCon($idContrato, $inversion){
        //Calculamos la ganancia diaria segun el contrato
        if($idContrato == 1){
          $valorDiario = ($inversion*0.5)/100;
        }elseif($idContrato == 2){
          $valorDiario = ($inversion*0.8)/100;
        }else{
          $valorDiario = ($inversion*1.1)/100;
        }

        $gananciaDiaria = $valorDiario;


        $arrayResult = array(
            'valorDiario'=> $valorDiario,
            'gananciaDiaria'=> $gananciaDiaria
        );

        //Calculamos valor diario
        return $arrayResult;
    }

    public function upgradeContrato(Request $request){
      $validErro = false;
      if($request->ajax()){
        $referiContrato = ReferidosContratos::find($request->idrefconup);
        $valorInverAnte = $referiContrato->valor_inversion;
        $referiContrato->valor_inversion = (($valorInverAnte)+$request->upgradevalor);
        $referiContrato->save();

        $fianzaUpgrade = Finanzas::find($request->idfinanzaupsm);

        $upContrato = new UpgradeContrato;
        $upContrato->id_user = $request->iduserup;
        $upContrato->id_referencia_contrato = $request->idrefconup;
        $upContrato->id_finanza = $request->idfinanzaupsm;
        $upContrato->valor_upgrade = $request->upgradevalor;
        $upContrato->valor_utilidad_anterior = $fianzaUpgrade->valor_utilidad;
        $upContrato->valor_diario_anterior = $fianzaUpgrade->valor_diario;
        $upContrato->valor_inversion_anterior = $valorInverAnte;
        $upContrato->fecha_upgrade = date("Y-m-d H:i:s");
        $upContrato->fecha_aux_upgrade = date("Y-m-d H:i:s");
        $upContrato->save();

        $updteValorDiario = (($fianzaUpgrade->ganancia_diaria*$referiContrato->valor_inversion)/100);
        $fianzaUpgrade->valor_diario = $updteValorDiario;

        if($fianzaUpgrade->save()){
          return response()->json([
              'envio' => true,
              'mensaje' => 'Upgrade realizado correctamente.'
          ]);
        }else{
          $validErro = true;
        }
      }else{
        $validErro = true;
      }

      if($validErro){
        return response()->json([
            'envio' => false,
            'mensaje' => 'Lo sentimos hubo un error en su Upgrade.'
        ]);
      }

    }

    static function calcularRefNvl1($codRef){
      //Consultamos referidos de nivel 1 - directos
      $referidos = User::where('id_tipo_cuenta','2')
                       ->where('codigo_referido_padre_users', $codRef)
                       ->select('id_user','codigo_referido_users')
                       ->get();

      $arrayRef = array();
      $comi_nivel_1 = 0;
      if(isset($referidos[0])){
        foreach ($referidos as $key => $referido) {
          $contratoRefs = ReferidosContratos::where('id_user',$referido->id_user)
                            ->where('estado_referido_contratos', 1)
                            ->select('id_referidos_contratos','valor_inversion')
                            ->get();
          if(isset($contratoRefs[0])){
            foreach ($contratoRefs as $key => $contratoRef) {
              $comi_nivel_1 += ($contratoRef->valor_inversion*0.03);       
            }
          }
        }
      }
      return $comi_nivel_1;
    }

    static function calcularRefNvl2($codRef){
      //Consultamos referidos de nivel 2 - indirectos
      $referidos = User::where('id_tipo_cuenta','2')
                       ->where('codigo_referido_padre_users', $codRef)
                       ->select('id_user','codigo_referido_users')
                       ->get();
      $ref = array();
      $comi_nivel_2 = 0;
      if(isset($referidos[0])){
        foreach ($referidos as $key => $referido) {
          $ref = User::where('id_tipo_cuenta','2')
                         ->where('codigo_referido_padre_users', $referido->codigo_referido_users)
                         ->select('id_user','codigo_referido_users')
                         ->get();

          if(isset($ref[0])){
            foreach ($ref as $key => $refCo) {
              $contratoRefs = ReferidosContratos::where('id_user',$refCo->id_user)
                                ->where('estado_referido_contratos', 1)
                                ->select('id_referidos_contratos','valor_inversion')
                                ->get();
              if(isset($contratoRefs[0])){
                foreach ($contratoRefs as $key => $contratoRef) {
                  $comi_nivel_2 += ($contratoRef->valor_inversion*0.02);
                }
              }
            }
          }
        }
      }

      return $comi_nivel_2;

    }

    static function calcularRefNvl3($codRef){
      //Consultamos referidos de nivel 3 - indirectos
      $referidos = User::where('id_tipo_cuenta','2')
                       ->where('codigo_referido_padre_users', $codRef)
                       ->select('id_user','codigo_referido_users')
                       ->get();
      $ref = array();
      $comi_nivel_3 = 0;
      if(isset($referidos[0])){
        foreach ($referidos as $key => $referido) {
          $ref = User::where('id_tipo_cuenta','2')
                         ->where('codigo_referido_padre_users', $referido->codigo_referido_users)
                         ->select('id_user','codigo_referido_users')
                         ->get();

          if(isset($ref[0])){
            foreach ($ref as $key => $refCo) {
              $ref2 = User::where('id_tipo_cuenta','2')
                         ->where('codigo_referido_padre_users', $refCo->codigo_referido_users)
                         ->select('id_user','codigo_referido_users')
                         ->get();
              if(isset($ref2[0])){
                foreach ($ref2 as $key => $refCo2) {
                  $contratoRefs = ReferidosContratos::where('id_user',$refCo2->id_user)
                                    ->where('estado_referido_contratos', 1)
                                    ->select('id_referidos_contratos','valor_inversion')
                                    ->get();
                  if(isset($contratoRefs[0])){
                    foreach ($contratoRefs as $key => $contratoRef) {
                      $comi_nivel_3 += ($contratoRef->valor_inversion*0.01);
                    }
                  }
                }
              }
            }
          }
        }
      }
      return $comi_nivel_3;
    }


    public function verBalances($id){
      $balances = Finanzas::where('finanzas.id_user',$id)
                         ->join('contratos', function($join) {
                              $join->on('finanzas.id_contrato', '=', 'contratos.id_contrato');
                          })
                         ->select('finanzas.valor_utilidad', 'finanzas.valor_diario','contratos.nombre_contrato','finanzas.id_referidos_contratos')
                         ->get()->toArray();
      
      if(count($balances) > 0){
        $arrayResult = [];
        foreach ($balances as $key => $balance) {
          $inversion = ReferidosContratos::find($balance['id_referidos_contratos']);
          if(isset($inversion)){
            if($inversion->id_referidos_contratos == $balance['id_referidos_contratos']){
              $balance['inversion'] = $inversion->valor_inversion;
              $balance['fecha_acti'] = Carbon::parse($inversion->datatime_activacion)->format('d-m-Y');
              $balance['fecha_venc'] = Carbon::parse($inversion->datatime_vencimiento)->format('d-m-Y');
              $arrayResult[] = $balance;
            }
          }
        }
        
        return response()->json([
            'envio' => true,
            'mensaje' => $arrayResult
        ]);
      }else{
        return response()->json([
            'envio' => false,
            'mensaje' => 'No se encontraton balances activos para este usuario.'
        ]);
      }
    }

}
