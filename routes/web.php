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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => 'moscow'], function() use($app){
    $app->post('ranking', ['uses' => 'MoscowController@calcularRanking']);
});

$app->group(['prefix' => 'dollar'], function() use($app){
   $app->post('ranking', ['uses' => 'DollarController@calcularRanking']);
});

$app->group(['prefix' => 'ahp'], function() use($app){
   $app->post('ranking', ['uses' => 'AHPController@calcularRanking']);
});

$app->group(['prefix' => 'wiegers'], function() use($app){
   $app->post('ranking', ['uses' => 'WiegersController@calcularRanking']);
});