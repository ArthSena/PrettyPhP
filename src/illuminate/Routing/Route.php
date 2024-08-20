<?php namespace Illuminate\Routing;

class Route {

    protected string $identifier;

    protected array $data = [];

    /**
     * Constructs a new Route instance.
     *
     * @param string $identifier The unique identifier for the route.
     * @param string $method The HTTP method associated with the route.
     * @param mixed $callback The callback function or controller method to be executed when the route is matched.
     * @param array $middlewares An optional array of middleware classes to be applied to the route.
     */
    public function __construct(string $identifier, string $method, mixed $callback, array $middlewares = [])  {
        $this->identifier = str_starts_with($identifier, '/') ? substr($identifier, 1) : $identifier;
        $this->setData($method, $callback, $middlewares);
    }

    /**
     * Checks if the current route matches the given HTTP method and path.
     *
     * @param string $method The HTTP method to match (e.g., GET, POST, PUT, DELETE).
     * @param string $path The path to match.
     *
     * @return bool Returns true if the route matches the given method and path; otherwise, false.
     */
    public function match(string $method, string $path): bool {
        return isset($this->data[$method]) && $this->identifier === $path;
    }

    /**
     * Retrieves the unique identifier for the route.
     *
     * @return string The unique identifier for the route.
     */
    public function getIdentifier(): string {
        return $this->identifier;
    }

    /**
     * Retrieves the callback function associated with the given HTTP method.
     *
     * @param string $method The HTTP method to retrieve the callback for (e.g., GET, POST, PUT, DELETE).
     *
     * @return mixed The callback function associated with the given HTTP method.
     * If the method does not exist in the route data, null will be returned.
     */
    public function getCallback(string $method): mixed {
        return $this->data[$method]['callback'];
    }

    /**
     * Retrieves the middleware classes associated with the given HTTP method.
     *
     * @param string $method The HTTP method to retrieve the middleware classes for (e.g., GET, POST, PUT, DELETE).
     *
     * @return array An array of middleware classes associated with the given HTTP method.
     * If the method does not exist in the route data, an empty array will be returned.
     */
    public function getMiddlewares(string $method): array {
        return $this->data[$method]['middlewares'];
    }

    /**
     * Sets the callback function and middleware classes for a specific HTTP method.
     *
     * @param string $method The HTTP method to associate the callback and middleware with (e.g., GET, POST, PUT, DELETE).
     * @param mixed $callback The callback function or controller method to be executed when the route is matched.
     * @param array $middlewares An optional array of middleware classes to be applied to the route.
     */
    public function setData(string $method, mixed $callback, array $middlewares = []) {
        $this->data[$method] = [
            "callback" => $callback,
            "middlewares" => $middlewares
        ];
    }

    /**
     * Checks if route data exists for the given HTTP method.
     *
     * This method verifies if the route has any data associated with the specified HTTP method.
     *
     * @param string $method The HTTP method to check for route data (e.g., GET, POST, PUT, DELETE).
     *
     * @return bool Returns true if route data exists for the given HTTP method; otherwise, false.
     */
    public function hasData(string $method): bool {
        return isset($this->data[$method]);
    }
    
}