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
Auth::routes(['register' => false, 'reset' => false]);
Route::get('/logout','Auth\LoginController@logout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth','admin']], function() {
	
	Route::resource('/usuarios','Administrar\Usuario\UsuarioController');

	Route::resource('/proveedor','Administrar\Proveedor\ProveedorController');

	Route::resource('/categoria','Administrar\Categoria\CategoriaController');

	Route::resource('/marca','Administrar\marca\MarcaController');

	Route::resource('/producto','Administrar\producto\ProductoController');

	Route::resource('/compras', 'Compra\CompraController');
	Route::get('/compras-producto/{criterio}','Compra\CompraController@producto');
	Route::get('/compras-obtener/{request}','Compra\CompraController@compra');
});

Route::group(['middleware' => ['auth','digitador']], function() {});

Route::group(['middleware' => ['auth','vendedor']], function() {});
