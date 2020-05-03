<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

use App\Pais;
use App\User;

use Auth;
use Redirect;
use Session;
use DB;
use App\Http\Requests;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except'=>'logout']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('iniciar-sesion.index');
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
    public function store(LoginRequest $request)
    {
        if(Auth::attempt(['email'=>$request['email'], 'password'=> $request['password']])){
          return Redirect::to('admin');
        }
        Session::flash('message-error', 'Datos son incorrecto');
        return Redirect::to('/iniciar-sesion');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/iniciar-sesion');
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
