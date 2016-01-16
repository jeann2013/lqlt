<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CuentaPersonal;
use App\EmailCuenta;
use App\Cliente;
use App\ClientePersonal;


class CuentaPersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $cuenta = \App\CuentaPersonal::get();

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cuenta = new CuentaPersonal();
        $checkDigit =  md5($request->checkDigitC);

        $emailcuenta = EmailCuenta::where('codigo_verificador','=',$checkDigit)->get();
         
        $existe_cedula = $this->search_cedula($request->cip);

        if($existe_cedula==0)
        {
            $cuenta_id=$emailcuenta->pluck('cuenta_id')->first();
            $cuenta->cuenta_id = $cuenta_id;
            $cuenta->cedula=$request->cip;
            $cuenta->digito_verificador=$checkDigit;
            $cuenta->tipo_identificacion_id=$request->identype;
            $cuenta->sucursal_preferencia_id=$request->preofficeC;
            $cuenta->fecha_creacion=date('Y-m-d H:i:s');
            $cuenta->fecha_modificacion=date('Y-m-d H:i:s');
            $cuenta->save();

            return response()->json([
                "msg"=>"Success",
                "ced"=>"Saved",
                ],200
            );


        }else{
            return response()->json([
                "msg"=>"Success",
                "ced"=>"Existe",
                ],200
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * Display the specified resource.
     *
     * @param  string  $ruc
     * @return \Illuminate\Http\Response
     */
    public function search_cedula($cedula)
    {
        $cuenta = CuentaPersonal::where('cedula','=',$cedula)->get();
        $cuentas = count($cuenta);
        return $cuentas;
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
