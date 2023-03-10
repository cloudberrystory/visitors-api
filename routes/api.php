<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'visits'], function () use ($router) {
    $router->group(['prefix' => 'countries'], function () use ($router) {
        $router->get('', 'StatisticsController@getVisitsByCountries');
        $router->post('', 'StatisticsController@addVisitFromCountry');
    });
});
