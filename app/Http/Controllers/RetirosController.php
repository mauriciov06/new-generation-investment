<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Retiros;
use App\Contrato;
use App\ReferidosContratos;
use Auth;

class RetirosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->id_tipo_cuenta == 1){
            $retiros = Retiros::busquedausuario($request->get('codigo_r'),$request->get('direccion_b'))
                                ->orderBy('valor_retirar','ASC')
                                ->where('estado_retiro', 0)
                                ->paginate(10);
        }else{
            $retiros = Retiros::orderBy('valor_retirar','ASC')
                            ->where('id_user', Auth::user()->id_user)
                            ->paginate(10);
        }   

        return view('retiros.index', compact('retiros'));
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

        $retiroExis = Retiros::where('retiros.id_user', $request->iduser)
                                ->where('retiros.id_finanza', $request->idFinanza)
                                ->where('retiros.id_referidos_contratos', $request->idContratoReferido)
                                ->whereDate('fecha_solicitud_retiro', date('Y-m-d'))
                                ->get();
        if(!isset($retiroExis[0])){
            if($request->ajax()){
                $retiro = new Retiros;
                $retiro->id_user = $request->iduser;
                $retiro->id_finanza = $request->idFinanza;
                $retiro->valor_retirar = $request->valorRetiro;
                $retiro->id_referidos_contratos = $request->idContratoReferido;
                $retiro->fecha_solicitud_retiro = date("Y-m-d H:i:s");
                if($retiro->save()){
                    return response()->json([
                        'envio' => true,
                        'mensaje' => 'Retiro solicitado correctamente, espera ha que los administradores lo confirmen.'
                    ]);
                }
            }else{
                return response()->json([
                    'envio' => false,
                    'mensaje' => 'Lo sentimos hubo un error con su solicitud de retiro, actualze e intente de nuevo.'
                ]);
            }
        }else{
                return response()->json([
                    'envio' => false,
                    'mensaje' => 'Lo sentimos solo puedes solicitar un retiro por contrato cada dia de retiro.'
                ]);
            }
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
    public function destroy(Request $request)
    {
        $retiro = Retiros::find($request->id);
        if(isset($retiro)){
            $retiro->delete();
            return response()->json(['borrado'=>true,'mensaje'=>'Retiro eliminado correctamente.']);
        }else{
            return response()->json(['borrado'=>false]);
        }
    }

    public function updateEstadoRetiro(Request $request){
        if($request->ajax()){
            $retiroUser = Retiros::find($request->idRetiros);
            $retiroUser->estado_retiro = $request->estadoUpdate;
            $retiroUser->fecha_confirmado_retiro = date("Y-m-d H:i:s");
            if($retiroUser->update()){
                return response()->json([
                    'envio' => true
                ]);
            }
        }else{
            return response()->json([
                'envio' => false
          ]);
        }
    }

    static function countRetiros(){
        if(Auth::user()->id_tipo_cuenta == 1){
            $retiros = Retiros::where('estado_retiro', 0)->get();
        }else{
            $retiros = Retiros::where('id_user', Auth::user()->id_user)->get();
        } 
        
        if(isset($retiros[0])){
            return count($retiros);    
        }else{
            return 0;
        }
    }
    static function infoContrato($isuser, $isRefCont){
        $nombreContrato = ReferidosContratos::where('referidos_contratos.id_user',$isuser)
                            ->where('referidos_contratos.id_referidos_contratos',$isRefCont)
                            ->join('contratos', 'contratos.id_contrato', 'referidos_contratos.id_contrato')
                            ->select('nombre_contrato')
                            ->first();

        if(isset($nombreContrato)){
            return $nombreContrato->nombre_contrato;
        }else{
            return 'Contrato no identificado';
        }
    }

    public function infoRerito(){
        $listadoContratoUser = ReferidosContratos::where('referidos_contratos.id_user', Auth::user()->id_user)
                                  ->join('contratos', 'contratos.id_contrato','=','referidos_contratos.id_contrato')
                                  ->join('finanzas', 'finanzas.id_referidos_contratos','=','referidos_contratos.id_referidos_contratos')
                                  ->where('finanzas.valor_utilidad','>=',20)
                                  ->where('estado_referido_contratos',1)
                                  ->select('referidos_contratos.id_referidos_contratos', 'referidos_contratos.valor_inversion','contratos.nombre_contrato','finanzas.valor_utilidad', 'finanzas.id_finanza')
                                  ->get();

        if(isset($listadoContratoUser[0])){
            $idsRetiros = [];
            
            foreach ($listadoContratoUser as $itemContraUser) {
                $retiroExist = Retiros::where('id_finanza', $itemContraUser->id_finanza)
                                        ->whereDate('fecha_solicitud_retiro', date('Y-m-d'))
                                        ->select('id_finanza')
                                        ->first();

                if($retiroExist != null){
                    $idsRetiros[] = $retiroExist->id_finanza;
                }
            }

            if(empty($idsRetiros)){
                $idsRetiros = 0;
            }

            return response()->json([
                'estado' => true,
                'liscontrato' => $listadoContratoUser,
                'idsretexis' => $idsRetiros
            ]);
        }else{
            return response()->json([
                'estado' => false
            ]);
        }
    }

}
