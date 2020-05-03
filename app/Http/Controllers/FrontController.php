<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\ReferidosContratos;
use Auth;

class FrontController extends Controller
{
    public function admin(){
    	$idUser = User::find(Auth::user()->id_user);

    	$patrocinador = User::where('id_tipo_cuenta',2)
    						->where('codigo_referido_users', $idUser->codigo_referido_padre_users)->first();

    	if($idUser != null && $idUser->direccion_billetera == null && Auth::user()->id_tipo_cuenta == 2){
    		$direccionBilletera = true;

    		return view('admin.index', compact('direccionBilletera','idUser','patrocinador'));
    	}else{
            return view('admin.index', compact('idUser','patrocinador')); 
    	}

    }
}
