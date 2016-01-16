<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteDepartamento extends Model
{
	/**
      * The database table used by the model.
     * @author Jean Carlos Nunez
     * @var string
     */
    protected $table = 'cliente_comercio_departamento';

    /**
     * The attributes that are mass assignable.
     * @author Jean Carlos Nunez
     * @var array
     */
    protected $fillable = ['cliente_comercio_id', 'departmento','fecha_creacion','fecha_modificacion'];

    public $timestamps = false;
}
