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

// Route::get('/', function () {
//     return view('home');
// });

Route::resource('/', 'FrontendController');

Route::group(['middleware' => 'autenticacion'], function(){
    //Ofertas
    Route::resource('ofertas', 'OfertasController');
});

//Route::group(['middleware' => 'autenticacion'], function(){

	//Ofertas
	//Route::resource('ofertas', 'OfertasController');

	//Empresas
	Route::resource('empresas', 'EmpresasController');
	Route::get('/empresa/pagina', 'EmpresasController@paginaEmpresa');

	//Aspirantes
    Route::resource('aspirantes', 'AspirantesController');
    Route::get('/aspirante/pagina', 'AspirantesController@paginaAspirante');
    Route::get('/aspirante/escritorio', 'AspirantesController@escritorioAspirante');
    Route::get('/aspirante/lvacantes', 'AspirantesController@lvacantes');
    Route::get('/aspirante/laspirantes', 'AspirantesController@laspirantes');

//});

//Inicio de sesion
Route::resource('login', 'LoginController');
Route::get('/iniciar-sesion', 'LoginController@index');

//Cerrar sesion
Route::get('/logout', 'LoginController@logout');
