<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', function () {
    return redirect('iniciar-sesion');
});

Route::get('/', function () {
    return redirect('iniciar-sesion');
});

Route::group(['middleware' => 'autenticacion'], function(){

	Route::get('/admin', 'FrontController@admin');

	//Usuarios
	Route::resource('usuarios', 'UsuarioController');
	Route::get('usuarios/{id}/edit', 'UsuarioController@edit');
	Route::get('usuarios/d/{dirBilletera}/{id}', 'UsuarioController@direccionBilletera');

	//Referidos
	Route::resource('referidos', 'ReferidoController');
	Route::get('referidos/{id}/edit', 'ReferidoController@edit');

	Route::get('referidos/n/{cod_ref}/{nivel}', 'ReferidoController@nivelReferido');

	//Mi cuenta
	Route::resource('cuenta', 'CuentaController');
	Route::get('cuenta/{id}', 'CuentaController@edit');
	Route::post('confirmacion-pago/', 'CuentaController@confirmarPago');
	Route::post('estado-confir-pago/', 'CuentaController@cambioEstadoConfiPag');
	Route::post('firma-contato/', 'CuentaController@firmaContrato');
	Route::get('confirmaciones-de-pago/', 'CuentaController@index');
	Route::get('validacion-contrato/{idUsuario}/{idContrato}', 'CuentaController@validacionContrato');

	//Retiros
	Route::resource('retiros', 'RetirosController');
	Route::post('estado-update-retiro/', 'RetirosController@updateEstadoRetiro');
	Route::post('guardar-retiro/', 'RetirosController@store');
	Route::get('info-retiro/', 'RetirosController@infoRerito');

	Route::get('detalles-cuenta/{id}', 'CuentaController@detallesCuenta');
	Route::get('activar-contratos/', 'CuentaController@activarContratos');
	Route::get('mis-contratos/{id}', 'CuentaController@misContratos');

	//Financias
	Route::get('balance', 'FinanzasController@balance');
	Route::get('actualizar-fechas-refcontratos', 'FinanzasController@actualizarFechaRefContra');
	Route::post('upgrade-contrato', 'FinanzasController@upgradeContrato');
	Route::get('balances/{id}', 'FinanzasController@verBalances');

	//Contratos
	Route::resource('contratos', 'ContratoController');
	Route::get('descargar-contrato/{id}', 'ContratoController@descargarContrato');
	Route::post('upload-contratos/', 'ContratoController@uploadcontrato');
	Route::get('listado-firmas-contrato/', 'ContratoController@listadoFirmasContrato');
	Route::post('listado-firmas-contrato/{id}', 'ContratoController@eliminarFirmaContrato');

});

//Iniciar sesion
Route::get('/iniciar-sesion', 'LogController@index');
Route::resource('login', 'LogController');

//Cerrar sesion
Route::get('/logout', 'LogController@logout');

//Registro por referido
Route::get('r/{hash}', 'ReferidoController@registroReferido');

//Registrarme
Route::resource('registrarme', 'RegistroController');

//Recuperar contraseña
Route::resource('recuperar-contrasena', 'ContrasenaController');
Route::resource('cambio', 'CambioController');
Route::get('cambiar-contrasena/{token}', 'ContrasenaController@CambiarContrasena')->name('cambioCorreo');