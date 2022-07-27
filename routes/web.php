<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\SalaryController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/index', 'UserDataController@index');

$router->get('/show', 'UserDataController@show');

$router->get('/create', 'UserDataController@create');

$router->post('/store', 'UserDataController@store');

$router->get('/manage/{id}', 'UserDataController@manage');

$router->post('/update/{id}', 'UserDataController@update');

$router->get('/delete/{id}', 'UserDataController@delete');

$router->get('/msal', 'UserDataController@totalmsalarycalc');

$router->get('/msal/{id}', 'UserDataController@msalarycalc');

$router->get('/attendance', 'SalaryController@att_marker');

$router->get('/adminvalidate', 'SalaryController@adminvalidate');

$router->post('/attstore', 'SalaryController@att_store');








