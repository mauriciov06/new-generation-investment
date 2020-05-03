<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ReferidoController; 
use App\Http\Requests\RegistroCreateRequest;

use App\Pais;
use App\User;
use App\Paquete;

use Auth;
use Redirect;
use Session;
use DB;
use App\Http\Requests;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Pais::pluck('nombre_pais','id_pais');
        return view('registro.index', compact('paises'));
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
    public function store(RegistroCreateRequest $request)
    {
        $data = $request->all();
        $user = User::create($data);
        $user->codigo_referido_users = ReferidoController::generateRandomRef(2).$user->id_user;
        $user->update();

        return redirect('/iniciar-sesion')->with('message','Referido registrado correctamente');
        /*if(Auth::attempt(['email'=>$request['email'], 'password'=> $request['password']])){
            return Redirect::to('admin');
        } */
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
