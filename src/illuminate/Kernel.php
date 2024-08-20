<?php namespace Illuminate;

class Kernel {

    function __construct() {
        new \Illuminate\Exceptions\ExceptionHandler();

        $db = new \Illuminate\Database\DB();
        $db->connect();
            
        $router = new \Illuminate\Routing\Router();
        $routeHandler = new \Illuminate\Routing\RouteHandler($router);

        $request = new \Illuminate\Http\Request($_GET, $_POST);

        $routeHandler->loadRoutes(APP['public_routes']);

        $routeHandler->handle($request);
    }

}