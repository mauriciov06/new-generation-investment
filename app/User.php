<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'id_tipo_cuenta',
        'avatar_users',
        'tipo_documento',
        'numero_documento',
        'direccion_users',
        'telefono_users',
        'celular_users',
        'id_pais',
        'direccion_billetera',
        'codigo_referido_users',
        'codigo_referido_padre_users',
        'estado_users',
        'id_contrato_firma',
        'password',
        'recuperar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Se crea un mutador para modificar elementos antes de ser guardados.
    public function setAvatarUsersAttribute($avatar){
        if(!empty($avatar && $avatar != 'default-avatar.png')){
            $name = Carbon::now()->second.$avatar->getClientOriginalName();
            $this->attributes['avatar_users'] = $name;

            $destinationPath = public_path(). '/avatares/';
            $avatar->move($destinationPath, $name);
        }else{
            $this->attributes['avatar_users'] = Carbon::now()->second.'default-avatar.png';
        }
        
    }

    public function setPasswordAttribute($valor){
        if(!empty($valor)){
            $this->attributes['password'] = bcrypt($valor);
        }
    }

    public function scopeBusquedaUsuario($query, $codigor){
      if(trim($codigor) != ''){
        return $query->where('codigo_referido_users', $codigor);
      }
    }
}
