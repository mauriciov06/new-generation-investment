<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContratosLegales extends Model
{
    protected $table = 'contratos_legales';

    protected $primaryKey = 'id_contrato_legal';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_completo','numero_documento','id_usuario'];
}
