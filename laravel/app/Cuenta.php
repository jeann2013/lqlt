<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    /**
     * The database table used by the model.
     * @author Jean Carlos Nunez
     * @var string
     */
    protected $table = 'cuenta';

    /**
     * The attributes that are mass assignable.
     * @author Jean Carlos Nunez
     * @var array
     */
    protected $fillable = ['nombre', 'apellido', 'email','clave','fecha_nacimiento','fecha_creacion','fecha_modificacion','activo','fechadesactiva'];

    public $timestamps = false;
    
}
