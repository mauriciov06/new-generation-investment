<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecuperarContrasenaRequest;
use App\Http\Requests\CambiarContrasenaRequest;
use Illuminate\Support\Facades\DB;
use App\User;
use Mail;

class ContrasenaController extends Controller
{
    
    public function index()
    {
        return view("contrasena.index");
    }
    
    public function store(RecuperarContrasenaRequest $request){
        $user=new User();
        $user = DB::table('users')->where('email', $request['email'])->first();
         if(!is_null($user)){
            DB::table('users')->where('email', $request['email'])->update(['recuperar' => 1]);
            $token=route('cambioCorreo', ['token' => encrypt($request['email'],"traders")]);
            Mail::send('contrasena.correo', ['usuario'=>$user,'token'=>$token], function($msj) use ($request){
                $msj->subject('Recuperar Contraseña');
                $msj->to($request['email']);
              });
            return redirect('/recuperar-contrasena')->with('message','Hemos enviado un correo para recuperar su contraseña');
        }else{
            return redirect('/recuperar-contrasena')->with('message-error','El correo ingresado no ha sido registrado');
        }
        
    }
    public function CambiarContrasena($token){
        $email=decrypt($token,"traders");
        $user=new User();
        $user = DB::table('users')->where('email', $email)->first();
         if(!is_null($user) and $user->recuperar==1){
           // DB::table('users')->where('email', $email)->update(['recuperar' => 0]);
            return view('contrasena.cambiarContrasena')->with('email', $email);
        }else{
            return redirect('/recuperar-contrasena')->with('message-error','El enlace solicitado ya no esta vigente');
        }
    }
  
     public function cambio(CambiarContrasenaRequest $request){
        DB::table('users')->where('email', $request->email)->update(['recuperar' => 0]);
        $usuario=new User();
        $usuario = DB::table('users')->where('email', $request->email)->first();
        $usuario->fill($request->all());
        $usuario->save();
     }

    function encrypt($string, $key) {
        $result = '';
        for($i=0; $i<strlen($string); $i++) {
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)+ord($keychar));
           $result.=$char;
        }
        return base64_encode($result);
     }

     function decrypt($string, $key) {
        $result = '';
        $string = base64_decode($string);
        for($i=0; $i<strlen($string); $i++) {
           $char = substr($string, $i, 1);
           $keychar = substr($key, ($i % strlen($key))-1, 1);
           $char = chr(ord($char)-ord($keychar));
           $result.=$char;
        }
        return $result;
     }

}
