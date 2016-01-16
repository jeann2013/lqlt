<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CuentaComercial;
use App\EmailCuenta;
use App\Cliente;
use App\ClienteComercial;


class CuentaComercialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuenta = \App\CuentaComercial::get();

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
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cuenta = new CuentaComercial();
        $checkDigit =  md5($request->checkDigit);

        $emailcuenta = EmailCuenta::where('codigo_verificador','=',$checkDigit)->get();
         
        $existe_ruc = $this->search_ruc($request->ruc);

        if($existe_ruc==0)
        {
            $cuenta_id=$emailcuenta->pluck('cuenta_id')->first();
            $cuenta->cuenta_id = $cuenta_id;
            $cuenta->ruc=$request->ruc;
            $cuenta->digito_verificador=$checkDigit;
            $cuenta->razon_social=$request->businessname;
            $cuenta->nombre_comercial=$request->tradename;
            $cuenta->sucursal_preferencia_id=$request->preoffice;
            $cuenta->fecha_creacion=date('Y-m-d H:i:s');
            $cuenta->fecha_modificacion=date('Y-m-d H:i:s');
            $cuenta->save();

            return response()->json([
                "msg"=>"Success",
                "ruc"=>"Saved",
                ],200
            );


        }else{
            return response()->json([
                "msg"=>"Success",
                "ruc"=>"Existe",
                ],200
            );
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  string  $ruc
     * @return \Illuminate\Http\Response
     */
    public function search_ruc($ruc)
    {
        $cuenta = CuentaComercial::where('ruc','=',$ruc)->get();
        $cuentas = count($cuenta);
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
