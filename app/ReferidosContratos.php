<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ReferidosContratos extends Model
{
    protected $table = 'referidos_contratos';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_referidos_contratos';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_user','id_contrato','id_paquete','estado_referido_contratos','datetime_solicitud','datetime_solicitud_temp','datatime_activacion','datatime_vencimiento'];

    public function scopeBusquedaUsuario($query, $codigor){
      if(trim($codigor) != ''){
        $idUser = User::where('codigo_referido_users', $codigor)->first();
        if($idUser != null){
            return $query->where('id_user', $idUser->id_user);    
        }
      }
    }
}
