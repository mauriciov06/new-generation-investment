<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finanzas extends Model
{
    protected $table = 'finanzas';

    protected $primaryKey = 'id_finanza';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_user','valor_utilidad','ganancia_diaria','valor_diario','estado_finanza','id_referidos_contratos'];
}
