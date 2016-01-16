<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEmailCuenta extends Model
{
       /**
     * The database table used by the model.
     * @author Jean Carlos Nunez
     * @var string
     */
    protected $table = 'tipo_email_cuenta';

    /**
     * The attributes that are mass assignable.
     * @author Jean Carlos Nunez
     * @var array
     */
    protected $fillable = ['descripcion'];

    public $timestamps = false;
}
