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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//$router->get('/db-test', function () use ($router) {
//    try {
//        DB::connection()->getPdo();
//        return "Database connection is successful!";
//    } catch (\Exception $e) {
//        return "Could not connect to the database. Error: " . $e->getMessage();
//    }
//});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    /** @see \App\Http\Controllers\AuthController */
    $router->post('login', 'AuthController@login');
//    $router->post('register', 'AuthController@register');

    /** @see \App\Http\Controllers\CompaniesController */
    $router->group(['prefix' => 'companies'], function () use ($router) {
        $router->get('/', 'CompaniesController@index');
        $router->get('/{companyId}', 'CompaniesController@show');
        $router->get('/{companyId}/jobs', 'CompaniesController@getJobsByCompany');
    });

    /** @see \App\Http\Controllers\JobsController */
    $router->group(['prefix' => 'jobs'], function () use ($router) {
        $router->get('/', 'JobsController@index');
        $router->get('/{jobId}', 'JobsController@show');
    });

    $router->group(['middleware' => ['auth']], function () use ($router) {

    });
});

