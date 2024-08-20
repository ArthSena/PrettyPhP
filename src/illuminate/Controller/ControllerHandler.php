<?php namespace Illuminate\Controller;

use Illuminate\Http\Request;

class ControllerHandler {

    public function handle(string $path, Request $request): mixed {
        $parts = explode('@', $path);

        $controller = 'App\\Controllers\\' . str_replace('.','\\', $parts[0]);
        $method = $parts[1];

        $obj = new $controller;
        
        if (!in_array(Controller::class, class_implements($controller))) {
            throw new \Exception("Controller {$controller} does not implement the Controller interface");
        }

        if (!method_exists($obj, $method)) {
            throw new \Exception("Method {$method} does not exist in controller {$controller}");
        }

        return $obj->$method($request);
    }

}