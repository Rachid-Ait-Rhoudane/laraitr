<?php

namespace core;

use core\middleware\Middleware;

class Router {

    private $routes = [];

    public function get($uri, $controller) {

        return $this->add($uri, $controller, 'GET');
    }

    public function post($uri, $controller) {

        return $this->add($uri, $controller, 'POST');
    }

    public function put($uri, $controller) {

        return $this->add($uri, $controller, 'PUT');
    }

    public function patch($uri, $controller) {

        return $this->add($uri, $controller, 'PATCH');
    }

    public function delete($uri, $controller) {

        return $this->add($uri, $controller, 'DELETE');
    }

    public function only($key) {

        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        return $this;
    }

    public function route($uri, $method) {

        if(array_key_exists($uri, $this->routes)) {

            if($this->routes[$uri]['method'] === strtoupper($method)) {

                return $this->resolve($this->routes[$uri]);
            }
        }

        foreach($this->routes as $path => $route) {

            if(count($route['params'])) {

                if(preg_match($path, $uri) && $route['method'] === strtoupper($method)) {
    
                    $paramsValues = $this->extract_values_from_uri($path, $uri, $route['params']);

                    return $this->resolve($route ,$paramsValues);
                }
            }
        }
        
        $this->abort();
    }

    private function add($uri, $controller, $method) {

        $dynamiqueRouteRegex = "#\{[a-z]([^/\s])*\}#i";

        $params = [];

        if(preg_match_all($dynamiqueRouteRegex, $uri, $matches)) {
            
            $params = array_map(function($param) {
                return mb_substr($param, 1, strlen($param) - 2);
            },  $matches[0]);

            $uri = "#^" . preg_replace($dynamiqueRouteRegex, "([^/\s])+", $uri) . "$#i" ;
        }        

        $this->routes[$uri] = [
            'controller' => $controller,
            'method' => $method,
            'params' => $params,
            'middleware' => null
        ];

        return $this;
    }

    private function resolve($route, $params = []) {

        Middleware::resolve($route['middleware'] ?? false);
    
        if(is_callable($route['controller'])) {

            return call_user_func_array($route['controller'], $params);
        }

        return call_user_func_array([new $route['controller'][0], $route['controller'][1]], $params);
    }

    private function extract_values_from_uri($dynamiqueRoute, $uri, $routeParams) {

        $paramsValues = [];

        $new_path = str_replace("([^/\s])+", "__PARAMVALUE__", $dynamiqueRoute);
    
        $explodedPath = explode("/", mb_substr($new_path, 3, strlen($new_path) - 6));

        $values = explode("/", mb_substr($uri, 1));

        for($i = 0, $j = 0; $i < count($explodedPath); $i++) {

            if($explodedPath[$i] === $values[$i]) {
                continue;
            }

            $paramsValues[$routeParams[$j++]] = $values[$i];
        }

        return  $paramsValues;
    }

    public function previousURL() {

        return $_SERVER['HTTP_REFERER'];
    }

    private function abort($code = Response::NOT_FOUND) {

        http_response_code($code);
        if(file_exists(base_path("views/{$code}.view.php"))) {
            view("{$code}");
        }
        die();
    }
}