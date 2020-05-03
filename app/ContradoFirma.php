<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContradoFirma extends Model
{
    protected $table = 'contrado_firmas';

    protected $primaryKey = 'id_contrato_firma';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_user','url_contrato'];
}
