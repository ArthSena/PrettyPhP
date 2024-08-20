<?php namespace Illuminate\Routing;

class Router {

    private static RouteCollector $routes;

    /**
     * Constructs a new Router instance.
     *
     * Initializes the RouteCollector instance to manage the application's routes.
     */
    public function __construct() {
        self::$routes = new RouteCollector();
    }

    /**
     * Registers a new route for the GET HTTP method.
     *
     * This method adds a new route to the application's route collection. The route is identified by a unique identifier,
     * and it will execute the provided callback function when a GET request is made to the specified route.
     *
     * @param string $identifier The unique identifier for the route.
     * @param callable $callback The callback function to be executed when the route is matched.
     * @param array $middlewares An optional array of middleware classes to be applied to the route.
     */
    public static function get($identifier, $callback, array $middlewares = []) {
        self::$routes->add($identifier, 'GET', $callback, $middlewares);
    }

    /**
     * Registers a new route for the POST HTTP method.
     *
     * This method adds a new route to the application's route collection. The route is identified by a unique identifier,
     * and it will execute the provided callback function when a POST request is made to the specified route.
     *
     * @param string $identifier The unique identifier for the route.
     * @param callable $callback The callback function to be executed when the route is matched.
     * @param array $middlewares An optional array of middleware classes to be applied to the route.
     */
    public static function post($identifier, $callback, array $middlewares = []) {
        self::$routes->add($identifier, 'POST', $callback, $middlewares);
    }

    /**
     * Registers a new route for the PUT HTTP method.
     *
     * This method adds a new route to the application's route collection. The route is identified by a unique identifier,
     * and it will execute the provided callback function when a PUT request is made to the specified route.
     *
     * @param string $identifier The unique identifier for the route.
     * @param callable $callback The callback function to be executed when the route is matched.
     * @param array $middlewares An optional array of middleware classes to be applied to the route.
     */
    public static function put($identifier, $callback, array $middlewares = []) {
        self::$routes->add($identifier, 'PUT', $callback, $middlewares);
    }

    /**
     * Registers a new route for the PATCH HTTP method.
     *
     * This method adds a new route to the application's route collection. The route is identified by a unique identifier,
     * and it will execute the provided callback function when a PATCH request is made to the specified route.
     *
     * @param string $identifier The unique identifier for the route.
     * @param callable $callback The callback function to be executed when the route is matched.
     * @param array $middlewares An optional array of middleware classes to be applied to the route.
     */
    public static function patch($identifier, $callback, array $middlewares = []) {
        self::$routes->add($identifier, 'PATCH', $callback, $middlewares);
    }

    /**
     * Registers a new route for the DELETE HTTP method.
     *
     * This method adds a new route to the application's route collection. The route is identified by a unique identifier,
     * and it will execute the provided callback function when a DELETE request is made to the specified route.
     *
     * @param string $identifier The unique identifier for the route.
     * @param callable $callback The callback function to be executed when the route is matched.
     * @param array $middlewares An optional array of middleware classes to be applied to the route.
     */
    public static function delete($identifier, $callback, array $middlewares = []) {
        self::$routes->add($identifier, 'DELETE', $callback, $middlewares);
    }

    /**
     * Registers a new route for the OPTIONS HTTP method.
     *
     * This method adds a new route to the application's route collection. The route is identified by a unique identifier,
     * and it will execute the provided callback function when a OPTIONS request is made to the specified route.
     *
     * @param string $identifier The unique identifier for the route.
     * @param callable $callback The callback function to be executed when the route is matched.
     * @param array $middlewares An optional array of middleware classes to be applied to the route.
     */
    public static function options($identifier, $callback, array $middlewares = []) {
        self::$routes->add($identifier, 'OPTIONS', $callback, $middlewares);
    }

    /**
     * Registers a new route for the 404 (Not Found) HTTP status code.
     *
     * This method adds a new route to the application's route collection. The route is identified by the string 'error_404',
     * and it will execute the provided callback function when a GET request is made to the specified route.
     * This route is typically used to handle 404 errors gracefully.
     *
     * @param callable $callback The callback function to be executed when the 404 route is matched.
     * This function should handle the 404 error and provide an appropriate response to the client.
     *
     * @param array $middlewares An optional array of middleware classes to be applied to the route.
     * Middleware classes can be used to perform pre-processing tasks or apply security measures before the callback function is executed.
     */
    public static function get404($callback, array $middlewares = []) {
        self::$routes->add('error_404', 'GET', $callback, $middlewares);
    }

    /**
     * Retrieves the collection of registered routes.
     *
     * This method returns an associative array containing all the routes registered in the application.
     * Each route is identified by a unique identifier and associated with its HTTP method, callback function,
     * and any middleware classes that are applied to the route.
     *
     * @return array An associative array containing the registered routes.
     */
    public static function getRoutes() {
        return self::$routes->getRoutes();
    }

    /**
     * Checks if a route with the given identifier and method exists in the route collection.
     *
     * @param string $identifier The unique identifier of the route to check.
     * @param string $method The HTTP method of the route to check.
     *
     * @return bool Returns true if a route with the given identifier and method exists; otherwise, returns false.
     */
    public static function has(string $identifier, string $method): bool {
        return self::$routes->has($identifier, $method);
    }

    /**
     * Retrieves a route from the collection based on its unique identifier.
     *
     * This method searches the route collection for a route with the given identifier.
     * If a matching route is found, it is returned. If no matching route is found, null is returned.
     *
     * @param string $identifier The unique identifier of the route to retrieve.
     *
     * @return Route|null Returns the Route object if a matching route is found, or null if no matching route is found.
     */
    public static function getRouteByIdentifier(string $identifier):?Route {
        return self::$routes->getRouteByIdentifier($identifier);
    }
}