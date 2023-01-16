<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(['namespace' => "V1", "prefix" => "v1"], function () use ($router) {

    $router->group(['middleware' => 'client_credential'], function () use ($router) {

        require_once ('authenticated/back_office.php');

    });

});
