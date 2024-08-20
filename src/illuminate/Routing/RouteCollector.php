<?php namespace Illuminate\Routing;

class RouteCollector {

    private array $routes = [];

    /**
     * Adds a new route to the collection.
     *
     * @param string $identifier The unique identifier for the route.
     * @param string $method The HTTP method for the route (e.g., GET, POST, PUT, DELETE).
     * @param mixed $callback The callback function or controller method to be executed when the route is matched.
     * @param array $middlewares An optional array of middleware classes to be applied to the route.
     *
     * @return void
     */
    public function add(string $identifier, string $method, mixed $callback, array $middlewares = []): void {
        if(isset($this->routes[$identifier])) 
            $this->routes[$identifier]->setData($method, $callback, $middlewares);
        else 
            $this->routes[$identifier] = new Route($identifier, $method, $callback, $middlewares);
    }

    /**
     * Retrieves all the routes registered in the collection.
     *
     * @return array An associative array containing all the routes, where the keys are the unique identifiers and the values are Route objects.
     */
    public function getRoutes(): array {
        return $this->routes;
    }

    /**
     * Checks if a route with the given identifier and method exists in the collection.
     *
     * @param string $identifier The unique identifier for the route.
     * @param string $method The HTTP method for the route (e.g., GET, POST, PUT, DELETE).
     *
     * @return bool Returns true if a route with the given identifier and method exists, false otherwise.
     */
    public function has(string $identifier, string $method): bool {
        return isset($this->routes[$identifier]) && $this->routes[$identifier]->hasData($method);;
    }

    /**
     * Retrieves a route from the collection based on its unique identifier.
     *
     * @param string $identifier The unique identifier for the route.
     *
     * @return Route|null Returns the Route object associated with the given identifier if it exists, or null if not found.
     */
    public function getRouteByIdentifier(string $identifier):?Route {
        return $this->routes[$identifier]?? null;
    }

}