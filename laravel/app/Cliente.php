<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
      /**
     * The database table used by the model.
     * @author Jean Carlos Nunez
     * @var string
     */
    protected $table = 'cliente';

    /**
     * The attributes that are mass assignable.
     * @author Jean Carlos Nunez
     * @var array
     */
    protected $fillable = ['nombre', 'apellido', 'tipo_identificacion_id','identificacion','digito_verificador','telefono','celular','sexo','fecha_nacimiento','direccion_id','fecha_creacion','fecha_modificacion'];

    public $timestamps = false;
}
