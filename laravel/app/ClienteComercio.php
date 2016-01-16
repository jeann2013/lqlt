<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteComercio extends Model
{
     /**
     * The database table used by the model.
     * @author Jean Carlos Nunez
     * @var string
     */
    protected $table = 'cliente_comercio';

    /**
     * The attributes that are mass assignable.
     * @author Jean Carlos Nunez
     * @var array
     */
    protected $fillable = ['nombre_comercial', 'ruc', 'razon_social','dv','direccion_web','departamento','direccion_id','otros_direccion','fecha_creacion','fecha_modificacion'];

    public $timestamps = false;
}
