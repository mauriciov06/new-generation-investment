<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ContradoFirma;
use App\User;

use Auth;
use Redirect;
use Session;
use DB;
use App\Http\Requests;

class ContratoController extends Controller
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

    public function uploadcontrato(Request $request){
        if($request->hasFile('adjunto_contrato')){
            if($request->file('adjunto_contrato')->getMimeType() == "application/pdf"){
                $file = $request->file('adjunto_contrato');
                $fechaunix = strtotime("now");
                $namefile = 'contrato_'.$request->id_user.'_'.$fechaunix.'.pdf';
                $file->move(public_path().'/contratos_firmados/', $namefile);

                $conFirma = new ContradoFirma;
                $conFirma->id_user = $request->id_user;
                $conFirma->url_contrato = $namefile;

                if($conFirma->save()){

                    $user = User::find($request->id_user);
                    $user->id_contrato_firma = $conFirma->id_contrato_firma;

                    if($user->save()){
                        return redirect('/descargar-contrato/'.$request->id_user)->with('message','Contrato subido correctamente.');
                    }
                }
            }else{
                return redirect('/descargar-contrato/'.$request->id_user)->with('message-error','Verifica que el archivo sea de tipo PDF.');
            }
        }else{
            return redirect('/descargar-contrato/'.$request->id_user)->with('message-error','No se ha subido el contrato correctamente, adjunta un archivo.');
        }
    }

    public function descargarContrato($id)
    {
        $conFirma = ContradoFirma::where('id_user', $id)->first();
        return view('firma-contrato.descarga-contrato', ['conFirma'=>$conFirma]);
    }

    public function listadoFirmasContrato(){

        $firmasContratos = ContradoFirma::paginate(10);

        return view('firma-contrato.listado-firma-contratos', ['firmasContratos'=>$firmasContratos]);
    }

    public function eliminarFirmaContrato(Request $request){

        $conFirma = ContradoFirma::where('id_user', $request->id)->first();
        
        if(isset($conFirma)){
            if($conFirma->url_contrato != null){
                $file_path = public_path().'/contratos_firmados/'.$conFirma->url_contrato;
                \File::delete($file_path);
            }
            $conFirma->delete();

            $user = User::find($request->id);
            $user->id_contrato_firma = null;
            $user->save();
            
            return response()->json(['borrado'=>true,'mensaje'=>'Firma de contrato eliminado correctamente.']);
        }else{
            return response()->json(['borrado'=>false]);
        }
    }

    static function countFirmascont(){
      $contFirmCount = ContradoFirma::get();

      if(isset($contFirmCount[0])){
        return count($contFirmCount);
      }else{
        return 0;
      }
    }
}
