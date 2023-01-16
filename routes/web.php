<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(['middleware' => 'responseTime'], function () use ($router) {

    require_once ("v1/v1.php");

});
