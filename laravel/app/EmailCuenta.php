<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailCuenta extends Model
{

    public function scopeCodigoVerificador($query,$checkDigit)
    {
        return $query->where('codigo_verificador', '=', $checkDigit);
    }


    /**
     * The database table used by the model.
     * @author Jean Carlos Nunez
     * @var string
     */
    protected $table = 'email_cuenta';

    /**
     * The attributes that are mass assignable.
     * @author Jean Carlos Nunez
     * @var array
     */
    protected $fillable = ['cuenta_id', 'email_para', 'asunto','cuerpo','tipo_email_id','fecha_enviado','messageid','codigo_verificador'];

    public $timestamps = false;
}
