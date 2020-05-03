<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

use App\Pais;
use App\User;

use Auth;
use Redirect;
use Session;
use DB;
use App\Http\Requests;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id_user','DESC')->where('id_tipo_cuenta','1')->paginate();
        $paises = Pais::pluck('nombre_pais','id_pais');

        return view('usuarios.index', compact('paises','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::pluck('nombre_pais','id_pais');
        return view('usuarios.create', compact('paises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        

        User::create($request->all());

        return redirect('/usuarios')->with('message','Usuario creado correctamente');
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
        return view('usuarios.edit', ['usuario'=>$usuario, 'paises'=>$paises]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $usuario = User::find($id);
        $usuario->fill($request->all());
        $usuario->save();

        return redirect('/usuarios')->with('message','Usuario actualizado correctamente');
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
            return response()->json(['borrado'=>true,'mensaje'=>'Usuario eliminado correctamente.']);
        }else{
            return response()->json(['borrado'=>false]);
        }
    }

    static function nombreCiudad($idPais){
        $pais = Pais::find($idPais);
        return $pais->nombre_pais;
    }

    static function countUsuarios(){
        $usuarios = User::where('id_tipo_cuenta', 1)->get();
        return count($usuarios);
    }

    public function direccionBilletera($dirBilletera, $idUsuario){
        $infoUser = User::find($idUsuario);
        $infoUser->direccion_billetera = $dirBilletera;
        if($infoUser->save()){
            return response()->json([
                'envio' => true
            ]);
        }else{
            return response()->json([
                'envio' => false
            ]);
        }
        
    }
}
