<?php namespace Illuminate\Http;

class Request { 

    private array $get = [];
    private array $post = [];

    /**
     * Constructs a new Request object with the provided GET and POST data.
     *
     * @param array $get The associative array containing the GET parameters.
     * @param array $post The associative array containing the POST parameters.
     */
    public function __construct(array $get, array $post) {
        $this->get = $get;
        $this->post = $post;
    }

    /**
     * Checks if the request contains any GET parameters.
     *
     * This method checks if the internal array of GET parameters is not empty.
     * If the array is not empty, it means that the request contains GET parameters.
     *
     * @return bool True if the request contains GET parameters, false otherwise.
     */
    public function hasGet() : bool { 
        return !empty($this->get);
    }

    /**
     * Checks if the request contains any POST parameters.
     *
     * This method checks if the internal array of POST parameters is not empty.
     * If the array is not empty, it means that the request contains POST parameters.
     *
     * @return bool True if the request contains POST parameters, false otherwise.
     */
    public function hasPost() : bool { 
        return !empty($this->post);
    }

    /**
     * Retrieves the value of a GET parameter with the given key.
     *
     * This method checks if the request contains any GET parameters and if the specified key exists.
     * If both conditions are met, it returns the value of the GET parameter.
     * If the request does not contain any GET parameters or the specified key does not exist,
     * it returns the provided default value.
     *
     * @param string $key The key of the GET parameter to retrieve.
     * @param mixed $default The default value to return if the GET parameter is not found or not set.
     *
     * @return mixed The value of the GET parameter if found, or the default value if not found or not set.
     */
    public function get(string $key, $default = null) : mixed {
        return $this->hasGet() && isset($this->get[$key]) ? $this->get[$key] : $default;
    }

    /**
     * Retrieves the value of a POST parameter with the given key.
     *
     * This method checks if the request contains any POST parameters and if the specified key exists.
     * If both conditions are met, it returns the value of the POST parameter.
     * If the request does not contain any POST parameters or the specified key does not exist,
     * it returns the provided default value.
     *
     * @param string $key The key of the POST parameter to retrieve.
     * @param mixed $default The default value to return if the POST parameter is not found or not set.
     *
     * @return mixed The value of the POST parameter if found, or the default value if not found or not set.
     */
    public function post(string $key, $default = null) : mixed {
        return $this->hasPost() && isset($this->post[$key])? $this->post[$key] : $default;
    }

    /**
     * Retrieves the URI of the current request, excluding any query parameters.
     *
     * This method extracts the URI from the $_SERVER['REQUEST_URI'] superglobal variable.
     * It removes any query parameters from the URI by locating the '?' character and
     * returning the substring before it. If no '?' character is found, the entire URI is returned.
     *
     * @return string The URI of the current request, excluding any query parameters.
     */
    public function getUri() : string {
        $uri = $_SERVER['REQUEST_URI'];
        $pos = strpos($uri, '?');
        return $pos === false? $uri : substr($uri, 0, $pos);
    }

    /**
     * Retrieves the query parameters from the URI of the current request.
     *
     * The method extracts the query parameters from the URI by locating the '?' character.
     * If no '?' character is found, an empty string is returned.
     *
     * @return string The query parameters from the URI, or an empty string if no query parameters are present.
     */
    public function getUriQuery() : string {
        $uri = $this->getUri();
        $pos = strpos($uri, '?');
        return $pos === false? '' : substr($uri, $pos + 1);
    }

    /**
     * Retrieves the HTTP method of the current request.
     *
     * The HTTP method is determined by the 'REQUEST_METHOD' superglobal variable.
     * This method returns the HTTP method as a string.
     *
     * @return string The HTTP method of the current request.
     */
    public function getMethod() : string {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Retrieves the IP address of the client making the current request.
     *
     * @return string The IP address of the client.
     */
    public function getIp() : string {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Retrieves the host name from the HTTP request headers.
     *
     * @return string The host name from the HTTP request headers.
     */
    public function getHost() : string {
        return $_SERVER['HTTP_HOST'];
    }

    /**
     * Retrieves the URI of the page that referred the current request.
     *
     * @return string The URI of the referring page.
     */
    public function getReferer() : string {
        return $_SERVER['HTTP_REFERER'];
    }

    /**
     * Retrieves the User-Agent header from the current request.
     *
     * The User-Agent header is a string that identifies the software (client) making the request.
     * It is sent by the client in the HTTP request headers and can be used by the server to identify
     * the client's software and its capabilities.
     *
     * @return string The User-Agent header value.
     */
    public function getUserAgent() : string {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * Retrieves the content type of the current request.
     *
     * The content type is determined by the 'CONTENT_TYPE' superglobal variable,
     * which is sent by the client in the HTTP request headers.
     *
     * @return string The content type of the current request.
     */
    public function getContentType() : string {
        return $_SERVER['CONTENT_TYPE'];
    }

    /**
     * Retrieves the length of the request body in bytes.
     *
     * This method retrieves the value of the 'CONTENT_LENGTH' server variable,
     * which represents the length of the request body in bytes.
     *
     * @return int The length of the request body in bytes.
     */
    public function getContentLength() : int {
        return (int) $_SERVER['CONTENT_LENGTH'];
    }

    /**
     * Retrieves the protocol (HTTP or HTTPS) and version used for the current request.
     *
     * @return string The protocol and version used for the current request.
     *
     * The returned string will be in the format "PROTOCOL/VERSION",
     * where "PROTOCOL" is either "HTTP" or "HTTPS", and "VERSION" is the version number.
     * For example, "HTTP/1.1" or "HTTPS/2.0".
     */
    public function getProtocol() : string {
        return $_SERVER['SERVER_PROTOCOL'];
    }

    /**
     * Retrieves the full URL of the current request, including protocol, host, and URI.
     *
     * This method constructs the full URL of the current request by concatenating the protocol, host, and URI.
     * The protocol is determined by the 'SERVER_PROTOCOL' superglobal variable, and the host is determined by the 'HTTP_HOST' superglobal variable.
     * The URI is determined by the 'REQUEST_URI' superglobal variable, and any query parameters are removed.
     *
     * @return string The full URL of the current request.
     */
    public function getFullUrl() : string {
        return $this->getProtocol().'://'.$this->getHost().$this->getUri();
    }
    
    /**
     * Retrieves the value of a specific HTTP header from the current request.
     *
     * This method retrieves the value of a specific HTTP header from the $_SERVER superglobal array.
     * The header name is case-insensitive and can be provided in any case.
     * If the header exists, its value is returned. If the header does not exist or is not set,
     * the method returns the provided default value.
     *
     * @param string $name The name of the HTTP header to retrieve.
     * @param mixed $default The default value to return if the HTTP header is not found or not set.
     *
     * @return mixed The value of the HTTP header if found, or the default value if not found or not set.
     */
    public function getHeader(string $name, $default = null) : mixed {
        $name = strtoupper(str_replace('-', '_', $name));
        return isset($_SERVER['HTTP_'. $name])? $_SERVER['HTTP_'. $name] : $default;
    }

    /**
     * Retrieves all the HTTP headers sent by the client.
     *
     * This method uses the built-in PHP function getallheaders() to retrieve all the HTTP headers sent by the client.
     * The headers are returned as an associative array, where the keys are the header names and the values are the corresponding header values.
     *
     * @return array An associative array containing all the HTTP headers sent by the client.
     */
    public function getAllHeaders() : array {
        return getallheaders();
    }

    /**
     * Retrieves the JSON body of the current request.
     *
     * This method reads the raw input data from the 'php://input' stream,
     * which contains the body of the HTTP request. It then decodes the JSON data
     * into an associative array using the json_decode function.
     *
     * @return array The JSON body of the current request as an associative array.
     *
     * @throws JsonException If the JSON data cannot be decoded.
     */
    public function getJsonBody() : array {
        $input = file_get_contents('php://input');
        return json_decode($input, true);
    }

    /**
     * Retrieves the value of a session variable with the given name.
     *
     * This method retrieves the value of a session variable from the $_SESSION superglobal array.
     * If the session variable exists, its value is returned. If the session variable does not exist or is not set,
     * the method returns the provided default value.
     *
     * @param string $name The name of the session variable to retrieve.
     * @param mixed $default The default value to return if the session variable is not found or not set.
     *
     * @return mixed The value of the session variable if found, or the default value if not found or not set.
     */
    public function getSession(string $name, $default = null) : mixed {
        return isset($_SESSION[$name])? $_SESSION[$name] : $default;
    }

    /**
     * Sets a session variable with the given name and value.
     *
     * This method assigns the provided value to a session variable with the specified name.
     * The session data is stored in the $_SESSION superglobal array, which persists across multiple requests.
     *
     * @param string $name The name of the session variable to set.
     * @param mixed $value The value to be assigned to the session variable.
     */
    public function setSession(string $name, mixed $value) {
        $_SESSION[$name] = $value;
    }

    /**
     * Removes a session variable with the given name.
     *
     * This method unsets the session variable associated with the specified name in the $_SESSION superglobal array.
     * If the session variable does not exist, this method does nothing.
     *
     * @param string $name The name of the session variable to remove.
     */
    public function removeSession(string $name) {
        unset($_SESSION[$name]);
    }

    /**
     * Checks if a session variable with the given name exists.
     *
     * This method checks if a session variable with the specified name exists in the $_SESSION superglobal array.
     * If the session variable exists, it returns true; otherwise, it returns false.
     *
     * @param string $name The name of the session variable to check.
     *
     * @return bool True if the session variable exists, false otherwise.
     */
    public function hasSession(string $name) : bool {
        return isset($_SESSION[$name]);
    }

    /**
     * Destroys the current session.
     *
     * This method uses PHP's built-in session_destroy function to destroy the current session.
     * All session data associated with the current session will be removed from the server.
     */
    public function destroySession() {
        session_destroy();
    }
    
    public function getFiles() : array {
        return $_FILES;
    }
    
    /**
     * Retrieves the value of a cookie with the given name.
     *
     * This method retrieves the value of a cookie from the $_COOKIE superglobal array.
     * If the cookie exists, its value is returned. If the cookie does not exist or is not set,
     * the method returns the provided default value.
     *
     * @param string $name The name of the cookie to retrieve.
     * @param mixed $default The default value to return if the cookie is not found or not set.
     *
     * @return mixed The value of the cookie if found, or the default value if not found or not set.
     */
    public function getCookie(string $name, $default = null) : mixed {
        return isset($_COOKIE[$name])? $_COOKIE[$name] : $default;
    }

    /**
     * Sets a cookie with the given parameters.
     *
     * This method uses PHP's built-in setcookie function to set a cookie with the provided parameters.
     * The cookie will be sent to the client's browser and stored in the client's cookies.
     *
     * @param string $name The name of the cookie.
     * @param mixed $value The value of the cookie.
     * @param int $expire The expiration time of the cookie in seconds. If set to 0, the cookie will expire at the end of the session.
     * @param string $path The path on the server in which the cookie will be available on. If set to '/', the cookie will be available on the entire domain.
     * @param string|null $domain The domain that the cookie is available to. If set to null, the cookie will be available to the current domain.
     * @param bool $secure Indicates whether the cookie should only be transmitted over a secure HTTPS connection.
     * @param bool $httpOnly Indicates whether the cookie should be accessible only through the HTTP protocol.
     */
    public function setCookie(string $name, mixed $value, int $expire = 0, string $path = '/', string $domain = null, bool $secure = false, bool $httpOnly = false) {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }

    /**
     * Removes a cookie with the given name from the client's browser.
     *
     * This method uses PHP's built-in setcookie function to set the value of the specified cookie to an empty string and
     * an expiration time in the past (3600 seconds ago). This effectively removes the cookie from the client's browser.
     *
     * @param string $name The name of the cookie to remove.
     */
    public function removeCookie(string $name) {
        setcookie($name, '', time() - 3600);
    }

    /**
     * Checks if a cookie with the given name exists in the client's browser.
     *
     * This method retrieves the value of the specified cookie from the $_COOKIE superglobal array.
     * If the cookie exists, it returns true; otherwise, it returns false.
     *
     * @param string $name The name of the cookie to check.
     *
     * @return bool True if the cookie exists, false otherwise.
     */
    public function hasCookie(string $name) : bool {
        return isset($_COOKIE[$name]);
    }

    /**
     * Flashes a value to the session for the next request.
     *
     * This method stores a value in the session under a unique key,
     * which will be removed after it is accessed during the next request.
     * This is useful for passing success or error messages between requests.
     *
     * @param string $name The unique key to store the value in the session.
     * @param mixed $value The value to be flashed. If not provided, the current value in the session will be removed.
     */
    public function flash(string $name, $value = null) {
        $_SESSION[$name.'_flash'] = $value;
    }
    
    /**
     * Retrieves a flashed value from the session for the next request.
     *
     * Flashed values are stored in the session for the next request only.
     * After being accessed, they are removed from the session.
     * This method is useful for passing success or error messages between requests.
     *
     * @param string $name The unique key to retrieve the flashed value from the session.
     * @param mixed $default The default value to return if the flashed value is not found in the session.
     *
     * @return mixed The flashed value or the default value if not found.
     */
    public function getFlash(string $name, $default = null) : mixed {
        $value = isset($_SESSION[$name.'_flash'])? $_SESSION[$name.'_flash'] : $default;
        unset($_SESSION[$name.'_flash']);
        return $value;
    }

    /**
     * Performs a HTTP redirect to the previous page (referer) if available,
     * otherwise redirects to the root URL ("/").
     *
     * This method first retrieves the referer URL using the getReferer() method.
     * If a referer URL is available, it calls the redirect() method with the referer URL.
     * If no referer URL is available, it calls the redirect() method with the root URL ("/").
     */
    public function back() {
        $referer = $this->getReferer();
        if ($referer) {
            $this->redirect($referer);
        } else {
            $this->redirect('/');
        }
    }

    /**
     * Performs a HTTP redirect to the specified URL.
     *
     * This method sends a HTTP redirect header to the client's browser,
     * instructing it to navigate to the specified URL.
     *
     * @param string $url The URL to redirect to.
     * @param int $status_code The HTTP status code for the redirect. Default is 302 (Found).
     */
    public function redirect(string $url, int $status_code = 302) {
        header('Location: '.$url, true, $status_code);
        exit;
    }

    /**
     * Refreshes the current page by redirecting to the current URL.
     *
     * This method sends a HTTP redirect header to the client's browser,
     * instructing it to reload the current page.
     * The method uses the full URL of the current request to perform the redirection.
     */
    public function refresh() {
        header('Location: '.$this->getFullUrl());
        exit;
    }

    /**
     * Sends a JSON response to the client.
     *
     * This method sets the appropriate HTTP headers and status code,
     * then encodes the provided data as JSON and outputs it to the client.
     *
     * @param array $data The data to be sent as JSON.
     * @param int $status_code The HTTP status code for the response. Default is 200 (OK).
     */
    public function jsonResponse(array $data, int $status_code = 200) {
        header('Content-Type: application/json');
        http_response_code($status_code);
        echo json_encode($data);
        exit;
    }
}