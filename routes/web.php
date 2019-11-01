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

	Route::resource('/inventario','Administrar\Inventario\InventarioController');

	Route::resource('/serie','Administrar\Serie\SerieController');

	Route::resource('/habilitar-facturas','Factura\SerieHabilitadaController');

	Route::get('/habilitar-facturas-info','Factura\SerieHabilitadaController@habilitadas');

	/*Rutas de graficos*/
	Route::get('/reporte-mensual','Reporte\ReporteController@mensual');

	Route::get('/reporte-mas-vendidos','Reporte\ReporteController@mas_vendidos');

	Route::get('/reporte-compras','Reporte\ReporteController@compras');

	Route::get('/reporte-ventas','Reporte\ReporteController@ventas');

});

Route::group(['middleware' => ['auth','digitador']], function() {

	Route::resource('/compras', 'Compra\CompraController');
	Route::get('/compras-producto/{criterio}','Compra\CompraController@producto');
	Route::get('/compras-obtener/{request}','Compra\CompraController@compra');
	Route::resource('/cliente','Administrar\Cliente\ClienteController');

});

Route::group(['middleware' => ['auth','vendedor']], function() {

	Route::resource('/ventas', 'Venta\VentaController');
	Route::get('/ventas-producto/{criterio}','Venta\VentaController@producto');
	Route::get('/ventas-obtener/{request}','Venta\VentaController@venta');
	Route::get('/series-habilitadas','Factura\SerieHabilitadaController@obtener_serie');

});

Route::get('/prueba/{id}', 'Venta\VentaController@prueba');

Route::get('/reporte-pdf-ventas','Reporte\ReportePdfController@venta');
Route::get('/reporte-pdf-venta-obtener/{request}','Reporte\ReportePdfController@venta_obtener');

Route::get('/reporte-pdf-compras','Reporte\ReportePdfController@compra');
Route::get('/reporte-pdf-compras-obtener/{request}','Reporte\ReportePdfController@compra_obtener');

Route::get('/reporte-pdf-inventario','Reporte\ReportePdfController@inventario');
Route::get('/reporte-pdf-inventario-obtener','Reporte\ReportePdfController@inventario_obtener');