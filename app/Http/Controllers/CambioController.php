<?php

namespace App\Http\Controllers;

use App\Http\Requests\CambiarContrasenaRequest;
use Illuminate\Support\Facades\DB;
use App\User;
use Mail;

class CambioController extends Controller
{

     public function store(CambiarContrasenaRequest $request){
        
        $usuario=new User();
        $usuario = DB::table('users')->where('email', $request['email'])->first();
        $usuario = User::find($usuario->id_user);
        $usuario->fill($request->all());
        $usuario->save();
        DB::table('users')->where('email', $request['email'])->update(['recuperar' => 0]);
        return redirect('/iniciar-sesion')->with('message','Contraseña actualizada correctamente');
     }

    

}
