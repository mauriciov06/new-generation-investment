<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReferidoCreateRequest;
use App\Http\Requests\ReferidoUpdateRequest;

use App\Pais;
use App\User;
use App\Paquete;

use Auth;
use Redirect;
use Session;
use DB;
use App\Http\Requests;

class ReferidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->id_tipo_cuenta == 1){
            $referidos = User::busquedausuario($request->get('codigo_r'))->orderBy('id_user','ASC')->where('id_tipo_cuenta','2')->paginate(10);
        }else{
            $referidos = User::busquedausuario($request->get('codigo_r'))->orderBy('id_user','ASC')
                           ->where('id_tipo_cuenta','2')
                           ->where('codigo_referido_padre_users', Auth::user()->codigo_referido_users)
                           ->paginate(10);
        }

        $paises = Pais::pluck('nombre_pais','id_pais');

        return view('referidos.index', compact('paises','referidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::pluck('nombre_pais','id_pais');
        $paquetes = Paquete::pluck('nombre_paquete','id_paquete');
        return view('referidos.create', compact('paises','paquetes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReferidoCreateRequest $request)
    {
        $data = $request->all();
        $user = User::create($data);
        $user->codigo_referido_users = self::generateRandomRef(2).$user->id_user;
        $user->update();

        return redirect('/referidos')->with('message','Referido creado correctamente');
    }

    static function generateRandomRef($length = 4) { 
        return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length).substr(strtotime("now"), 7); 
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
        $referido = User::find($id);
        $paquetes = Paquete::pluck('nombre_paquete','id_paquete');
        $paises = Pais::pluck('nombre_pais','id_pais');
        return view('referidos.edit', ['referido'=>$referido, 'paises'=>$paises, 'paquetes'=>$paquetes]);
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
        $referido = User::find($id);
        $referido->fill($request->all());
        $referido->save();

        return redirect('/referidos')->with('message','Referido actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        if(isset($user)){
            if($user->avatar_users != null){
                $file_path = public_path().'/avatares/'.$user->avatar_users;
                \File::delete($file_path);
            }
            $user->delete();
            return response()->json(['borrado'=>true,'mensaje'=>'Referido eliminado correctamente.']);
        }else{
            return response()->json(['borrado'=>false]);
        }
    }

    static function countReferidosList($codigoRef){
        $referidos = User::where('id_tipo_cuenta', 2)->where('codigo_referido_padre_users', $codigoRef)->get();
        return count($referidos);
    }

    static function countReferidos(){
        if(Auth::user()->id_tipo_cuenta == 1){
            $referidos = User::where('id_tipo_cuenta', 2)->get();
        }else{
            $referidos = User::where('id_tipo_cuenta', 2)->where('codigo_referido_padre_users', Auth::user()->codigo_referido_users)->get();    
        }
        
        return count($referidos);
    }

    public function registroReferido($hashRef){
        $paises = Pais::pluck('nombre_pais','id_pais');
        $referido = User::where('id_tipo_cuenta', 2)
                    ->where('codigo_referido_users', $hashRef)
                    ->select('name')
                    ->get();
        if(!isset($referido[0])){
            $referido = false;
        }
        return view('registro.index', compact('hashRef', 'referido', 'paises'));
    }

    public function nivelReferido($codReferido, $nivel){
        $referidos = User::orderBy('id_user','ASC')
                           ->where('id_tipo_cuenta','2')
                           ->where('codigo_referido_padre_users', $codReferido)
                           ->get();

        $paises = Pais::pluck('nombre_pais','id_pais');

        if($nivel == 1){
            $nivel = 2;
        }
        if($nivel == 2){
            $nivel = 3;
        }
        
        $noBuscador = 1;
        $noPaginado = 1;

        return view('referidos.index', compact('paises','referidos', 'nivel', 'noBuscador','noPaginado'));
    }
}
