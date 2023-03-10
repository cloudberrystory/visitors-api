<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'statistics'], function () use ($router) {
    $router->get('', 'StatisticsController@getStatistics');
    $router->put('', 'StatisticsController@updateStatistics');
});
