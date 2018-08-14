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



$router->post('/login', ['uses' => 'UserController@getToken']);

$router->post('/users', ['uses' => 'UserController@CreateUser']);

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function() {
     return str_random(32);
});

//$router->group(['middleware' =>['auth']], function() use ($router){
    
    $router->get('/users', ['uses' => 'UserController@ListUsers']);

    $router->post('/select', ['uses' => 'UserController@SelectUser']);

    $router->put('/alter', ['uses' => 'UserController@AlterUser']);

    $router->delete('/delete', ['uses' => 'UserController@DeleteUser']);
//});