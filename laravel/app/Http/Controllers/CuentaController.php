<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\EmailCuenta;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cuenta = \App\Cuenta::get();

        return response()->json([
            "msg"=>"Success",
            "cuenta"=>$cuenta->toArray(),
            ],200
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgot(Request $request)
    {
        //error_log($request->email);
        
        
        $existe_email = $this->search_email($request->email);

        if($existe_email==0)
        {
            return response()->json([
                "msg"=>"Success",
                "email"=>"No Existe",
                ],200
            );
        }else{

            $fecha_nacimiento = date_parse_from_format('Y-m-d',$request->birtdate);
            $fecha_nacimiento_real = $fecha_nacimiento['year']."-".$fecha_nacimiento['month']."-".$fecha_nacimiento['day'];

            $emailcuenta = new EmailCuenta();
            $cuenta = Cuenta::where('email','=',$request->email)->get();
            
            $cuenta_update = Cuenta::find($cuenta->pluck('id')->first());
           
            
            //$fecha_cumpleano = date('Y-m-d',$request->birtdate);
            $cuenta_update->fecha_nacimiento=$fecha_nacimiento_real;
            $cuenta_update->fecha_modificacion=date('Y-m-d H:i:s');
            
           
            $to      =  $request->email;
            $subject = 'Solicitud de cambio de clave de acceso al sistema d LQLT';
            $message = 'Hola: '.$cuenta->pluck('nombre')->first()."\n";
            $message .= "Anuentes de su deseo de acceder al sistema le brindamos un mecanismo para acceder, el mismo cuenta de 3 pasos:\n";
            $message .= "1) Acceda a este Link: http://lqlt-dev.smartsolutions.com.pa/#/lock"."\n";
            $message .= "2) Registre su nueva clave de acceso en esta pagina"."\n";
            $message .= "3) Entre al sistema nuevamente con su nueva clave de acceso"."\n";
            $message .= "Si usted no ha solicitado el cambio de clave, favor contactarse con\n";
            $message .= "seguridad@loquiereslotienes.com\n";
            $message .= "Saludos, \n";

             $headers = 'From: raul.yahtnel@smartsolutions.com.pa' . "\r\n".
                'Reply-To: dw@smartsolutions.com.pa' . "\r\n" .
                'X-Mailer: PHP/';        
            mail($to, $subject, $message, $headers);

           

            $emailcuenta->cuenta_id=$cuenta->pluck('id')->first();
            $emailcuenta->email_para=$request->email;
            $emailcuenta->asunto=$subject;
            $emailcuenta->cuerpo=$message;
            $emailcuenta->tipo_email_id=2;
            $emailcuenta->fecha_enviado=date('Y-m-d H:i:s');
            $emailcuenta->messageid=0;
            $emailcuenta->codigo_verificador="-";  


            $emailcuenta->save();
            toArray$cuenta_update->save();
            

            return response()->json([
                "msg"=>"Success",
                "email"=>$request->email,
                ],200
            );



        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cuenta = new Cuenta();
        $user = new User();
        $emailcuenta = new EmailCuenta();

        $existe_email = $this->search_email($request->email);

        if($existe_email==0)
        {

            $cuenta->clave=md5($request->password); //Se escripta la clave del usuario
            $cuenta->nombre=$request->firstName;
            $cuenta->apellido=$request->lastName;
            $cuenta->email=$request->email;
            $cuenta->fecha_nacimiento=date('Y-m-d');
            $cuenta->fecha_creacion=date('Y-m-d H:i:s');
            $cuenta->fecha_modificacion=date('Y-m-d H:i:s');
            $cuenta->activo=1;
            $cuenta->fechadesactiva=date('Y-m-d H:i:s');
           

            /*User Authentication*/
            $nombre = $request->firstName;
            $apellido = $request->lastName;
            $user->name=$nombre." ".$apellido;
            $user->email=$request->email;
            $user->password=bcrypt($request->password); //Se escripta la clave del usuario
            $cuenta->save();
            /*User Authentication*/
            
            $var_cod_veri = rand();

            $to      =  $request->email;
            $subject = 'Registro de Cuenta';
            $message = 'Hola: '.$request->firstName."\n";
            $message .= "Gracias por registrarse en nuestro portal de administracion de pedidos\n";
            $message .= "Favor confirmar su direccion de Correo mediante el siguiente link: http://lqlt-dev.smartsolutions.com.pa/#/subregistrationclient\n";
            //$message .= "Favor confirmar su direccion de Correo mediante el siguiente link: http://localhost:3000/#/subregistrationclient\n";
            $message .= "No Olvides sus Credenciales de Acceso:\n";
            $message .= "Url: http://lqlt-dev.smartsolutions.com.pa \n";
            $message .= "Usuario: ".$request->email."\n";
            $message .= "Código de Confirmación: ".$var_cod_veri."\n";
            $message .= "Saludos, \n";

            $emailcuenta->cuenta_id=$cuenta->id;
            $emailcuenta->email_para=$request->email;
            $emailcuenta->asunto=$subject;
            $emailcuenta->cuerpo=$message;
            $emailcuenta->tipo_email_id=1;
            $emailcuenta->fecha_enviado=date('Y-m-d H:i:s');
            $emailcuenta->messageid=0;
            $emailcuenta->codigo_verificador=md5($var_cod_veri);            
            $emailcuenta->save();
            
            
            $headers = 'From: raul.yahtnel@smartsolutions.com.pa' . "\r\n".
                'Reply-To: dw@smartsolutions.com.pa' . "\r\n" .
                'X-Mailer: PHP/';        
            mail($to, $subject, $message, $headers);

            
            $user->save();



            return response()->json([
                "msg"=>"Success",
                "email"=>$request->email,
                ],200
            );

        }else{

            return response()->json([
                "msg"=>"Success",
                "email"=>"Existe",
                ],200
            );

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function search_email($email)
    {
        
        //$email = $request->email;

        $cuenta = Cuenta::where('email','=',$email)->get();
        $cuentas = count($cuenta);

        // if($cuentas==0)
        // {
        //     // return response()->json([
        //     //     "msg"=>"Success",
        //     //     "cuenta"=>"EmptyRows",
        //     //     ],200
        //     // );

        // }else{
        //     // return response()->json([
        //     //     "msg"=>"Success",
        //     //     "cuenta"=>"1",
        //     //     ],200
        //     // );
        // }

        return $cuentas;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $cuenta = Cuenta::find($id);

        $cuentas = count($cuenta);

        if($cuentas==0)
        {
            return response()->json([
                "msg"=>"Success",
                "0"=>"EmptyRows",
                ],200
            );

        }else{
            return response()->json([
                "msg"=>"Success",
                "cuenta"=>$cuenta->toArray(),
                ],200
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
