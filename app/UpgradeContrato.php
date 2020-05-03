<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpgradeContrato extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_upgrade_contratos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'id_referencia_contrato',
        'id_finanza',
        'valor_upgrade',
        'valor_utilidad_anterior',
        'fecha_upgrade',
        'valor_inversion_anterior',
        'valor_diario_anterior',
        'fecha_aux_upgrade'
    ];
}
