<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->group(["prefix" => "api/productos"], function () use ($router) {
	$router->get("", "ProductosController@index");
	$router->post("", "ProductosController@store");
	$router->get("empresa/{idEmpresa}", "ProductosController@indexByEmpresa");
	$router->get("empresa/{idEmpresa}/count", "ProductosController@indexCountByEmpresa");
	$router->get("empresa/{idEmpresa}/subcategoria/{idSubCategoria}", "ProductosController@indexByEmpresaAndSubCategoria");
	$router->get("/{id}", "ProductosController@show");
	$router->get("/categoria/{idCategoria}", "ProductosController@showByCategoria");
	$router->put("/{id}", "ProductosController@update");
	$router->delete("/{id}", "ProductosController@destroy");
});
$router->group(["prefix" => "api/marcas"], function () use ($router) {
	$router->get("", "MarcaController@index");
	$router->get("empresa/{idEmpresa}","MarcaController@showByEmpresaId");
	$router->post("", "MarcaController@store");
	$router->get("/{id}", "MarcaController@show");
	$router->put("/{id}", "MarcaController@update");
	$router->delete("/{id}", "MarcaController@destroy");
});
$router->group(["prefix" => "api/medidas"], function () use ($router){
	$router->get("/empresa/{idEmpresa}","MedidasController@obtenerMedidasByEmpresa");
	$router->get("/{id}","MedidasController@show");
	$router->post("","MedidasController@store");
	$router->put("/{id}","MedidasController@update");
});
