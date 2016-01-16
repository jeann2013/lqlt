<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteContacto extends Model
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
    protected $fillable = ['cliente_id', 'nombre', 'apellido','telefono','celular','direccion_id','fecha_creacion','fecha_modificacion'];

    public $timestamps = false;
}
