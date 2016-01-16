<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteEspeciales extends Model
{
	/**
      * The database table used by the model.
     * @author Jean Carlos Nunez
     * @var string
     */
    protected $table = 'cliente_contacto';

    /**
     * The attributes that are mass assignable.
     * @author Jean Carlos Nunez
     * @var array
     */
    protected $fillable = ['cliente_id', 'limite_credito', 'limite_vigencia','porc_abono_pagar','recurrente','plan_recurrente_id','numero_cuenta_debitar','fecha_vencimiento','email_notificacion','fecha_creacion','fecha_modificacion'];

    public $timestamps = false;
}
