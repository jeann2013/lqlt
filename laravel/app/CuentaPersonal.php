<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaPersonal extends Model
{
      /**
     * The database table used by the model.
     * @author Jean Carlos Nunez
     * @var string
     */
    protected $table = 'cuenta_personal';

    /**
     * The attributes that are mass assignable.
     * @author Jean Carlos Nunez
     * @var array
     */
    protected $fillable = ['cuenta_id', 'tipo_identificacion_id', 'cedula','digito_verificador','fecha_creacion','fecha_modificacion','sucursal_preferencia_id'];

    public $timestamps = false;
}
