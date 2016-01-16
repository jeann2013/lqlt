<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('cliente', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('nombre', 60);   
            $table->string('apellido', 60);
            $table->integer('tipo_identificacion_id');
            $table->string('identificacion',20);            
            $table->string('digito_verificador',100);
            $table->string('telefono', 10);
            $table->string('celular', 10);
            $table->string('sexo', 1);
            $table->date('fecha_nacimiento');
            $table->integer('direccion_id');
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_modificacion');
            $table->engine = 'InnoDB';
        });

        Schema::create('cliente_comercio', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('nombre_comercial', 60);   
            $table->string('ruc', 60);
            $table->string('razon_social',128);
            $table->string('dv',10);            
            $table->string('direccion_web',256);
            $table->string('departamento', 128);
            $table->bigInteger('direccion_id');
            $table->string('otros_direccion', 256);
            $table->date('fecha_nacimiento');
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_modificacion');
            $table->engine = 'InnoDB';
        });

        Schema::create('cliente_comercio_departamento', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('cliente_comercio_id');   
            $table->string('departamento', 128);
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_modificacion');
            $table->engine = 'InnoDB';
        });

        Schema::create('cliente_contacto', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('cliente_id');   
            $table->string('nombre', 128);
            $table->string('apellido', 128);
            $table->string('telefono', 10);
            $table->string('celular', 128);
            $table->bigInteger('direccion_id');
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_modificacion');
            $table->engine = 'InnoDB';
        });

        Schema::create('cliente_especiales', function (Blueprint $table) {
            $table->bigInteger('cliente_id');   
            $table->double('limite_credito', 10,2);
            $table->bigInteger('limite_vigencia');
            $table->double('porc_abono_pagar', 10,2);
            $table->tinyInteger('recurrente');
            $table->integer('plan_recurrente_id');
            $table->string('numero_cuenta_debitar',20);
            $table->date('fecha_vencimiento');
            $table->string('email_notificacion',128);
            $table->dateTime('fecha_creacion');
            $table->dateTime('fecha_modificacion');
            $table->engine = 'InnoDB';
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cliente');
        Schema::drop('cliente_comercio');
        Schema::drop('cliente_comercio_departamento');
        Schema::drop('cliente_contacto');
        Schema::drop('cliente_especiales');
    }
}
