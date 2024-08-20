<?php namespace Illuminate\Routing;

use eftec\bladeone\BladeOne;
use Illuminate\Controller\ControllerHandler;
use Illuminate\Http\Request;

class RouteHandler {

    protected $router;

    /**
     * Constructs a new RouteHandler instance.
     *
     * @param Router $router The router instance to be used for route handling.
     */
    public function __construct(Router $router) {
        $this->router = $router;
    }

    /**
     * Loads the specified route files into the application.
     *
     * This method iterates through the provided array of route files and includes each file using the `require_once` directive.
     * This allows the routes defined in the included files to be registered with the application's router.
     *
     * @param array $routeFiles An array of route file paths to be loaded. If no files are provided, the method does nothing.
     *
     * @return void
     */
    public function loadRoutes(array $routeFiles = []) {
        foreach ($routeFiles as $value) {
            require_once __HOME_DIR__ . '/' . $value;
        }
    }

    /**
     * Handles the incoming request by matching it to a registered route and executing the corresponding callback.
     * If no matching route is found, it checks for a predefined 'error_404' route and executes it.
     * If no 'error_404' route is found, it returns a 404 error page. 
     *
     * @param Request $request The incoming request to be handled.
     *
     * @return mixed The result of executing the matched route's callback.
     *
     */
    public function handle(Request $request) {

        foreach ($this->router->getRoutes() as $route) {
            if ($this->matchesRoute($route, $request)) {
                return $this->callRoute($route, $request);
            }
        }

        if($this->router->has('error_404', 'GET' )){
            return $this->callRoute($this->router->getRouteByIdentifier('error_404'), $request);
        } else {
            $blade = new BladeOne('illuminate/View/Views', APP['cache_views_dir']);
            echo $blade->run('errors.error404');
        }
    }

    /**
     * Determines if the given request matches the specified route.
     *
     * This method extracts the request URI and method, removes any leading or trailing slashes,
     * and then compares them with the route's URI and method to determine if they match.
     *
     * @param Route $route The route to be matched against the request.
     * @param Request $request The incoming request to be checked for a match.
     *
     * @return bool True if the request matches the route; otherwise, false.
     */
    protected function matchesRoute(Route $route, Request $request) {
        $path = $request->getUri();

        if(str_starts_with($path, '/')) { 
            $path = substr($path, 1);
        }

        if(str_ends_with($path, '/')) { 
            $path = substr($path, 0, -1);
        }

        $method = $request->getMethod();

        return $route->match($method, $path);
    }

    /**
     * Calls the appropriate callback for the given route and request.
     *
     * This method determines the HTTP method of the request and checks if the route's callback is callable.
     * If the callback is a callable function, it is executed with the request as its parameter.
     * If the callback is a string representing a controller method, the ControllerHandler is used to handle the request.
     * If the callback is neither callable nor a string, an exception is thrown.
     *
     * @param Route $route The route for which the callback needs to be called.
     * @param Request $request The incoming request to be processed.
     *
     * @throws \Exception If the route callback is not callable.
     */
    protected function callRoute(Route $route, Request $request) {
        $method = $request->getMethod();

        if($route->getIdentifier() === 'error_404')  $method = 'GET';

        if(is_callable($route->getCallback($method))) {
            call_user_func_array($route->getCallback($method), [$request]);
            return;
        } 
        
        if(is_string($route->getCallback($method))){
            echo (new ControllerHandler())->handle($route->getCallback($method), $request);
            return;
        }

        throw new \Exception("Route callback is not callable");
    }

}