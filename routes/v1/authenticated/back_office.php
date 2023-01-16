<?php

use Laravel\Lumen\Routing\Router;

/**
 * @var Router $router
 */

$router->group(["namespace" => "BackOffice", "prefix" => "back-office"], function () use ($router) {

    $router->group(['middleware' => 'back_office_auth'], function () use ($router) {

        $router->get("sidebar-menus/{roleId}", 'SidebarMenusController@index');

    });

});
