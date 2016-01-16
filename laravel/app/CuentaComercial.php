<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaComercial extends Model
{
     /**
     * The database table used by the model.
     * @author Jean Carlos Nunez
     * @var string
     */
    protected $table = 'cuenta_comercial';

    /**
     * The attributes that are mass assignable.
     * @author Jean Carlos Nunez
     * @var array
     */
    protected $fillable = ['cuenta_id', 'ruc', 'digito_verificador','razon_social','nombre_comercial','sucursal_preferencia_id','fecha_creacion','fecha_modificacion'];

    public $timestamps = false;
}
