<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Retiros extends Model
{
	protected $table = 'retiros';

	protected $primaryKey = 'id_retiros';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'valor_retirar',
        'id_referidos_contratos',
        'estado_retiro',
        'fecha_solicitud_retiro',
        'fecha_confirmado_retiro',
    ];

    public function scopeBusquedaUsuario($query, $codigor, $direcBille){
      if(trim($codigor) != ''){
        $idUser = User::where('codigo_referido_users', $codigor)->first();
        if($idUser != null){
            return $query->where('id_user', $idUser->id_user);    
        }
      }elseif(trim($direcBille) != ''){
        $idUser = User::where('direccion_billetera', 'LIKE', "%$direcBille%")->first();
        if($idUser != null){
            return $query->where('id_user', $idUser->id_user);  
        }
      }
    }
}
