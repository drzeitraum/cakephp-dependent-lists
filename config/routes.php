<?php
/**
 * Routes configuration
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {

    # Products
    $routes->connect('/products/:action/:id', ['controller' => 'Products', 'action' => ':action'])->setPass(['id']); // edit

    $routes->fallbacks(DashedRoute::class);

});
