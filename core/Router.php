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

        foreach($this->routes as $route) {

            if(preg_match($route["uri"], $uri) && $route['method'] === strtoupper($method)) {

                Middleware::resolve($route['middleware'] ?? false);

                $paramsValues = [];

                if(!empty($route['params'])) {

                    $new_path = str_replace("([^/\s])+", "__PARAMVALUE__", $route['uri']);

                    $explodedPath = explode("/", mb_substr($new_path, 3, strlen($new_path) - 6));

                    $values = explode("/", mb_substr($uri, 1));

                    for($i = 0, $j = 0; $i < count($explodedPath); $i++) {

                        if($explodedPath[$i] === $values[$i]) {
                            continue;
                        }

                        $paramsValues[$route['params'][$j++]] = $values[$i];
                    }
                }

                if(is_callable($route['controller'])) {

                    return call_user_func_array($route['controller'], $paramsValues);
                }

                return call_user_func_array([new $route['controller'][0], $route['controller'][1]], $paramsValues);
            }
        }
        
        $this->abort();
    }

    private function add($uri, $controller, $method) {

        $dynamiqueRouteRegex = "#\{[a-z]([^/\s])*\}#i";

        $params = [];

        if(preg_match_all($dynamiqueRouteRegex, $uri, $matches)) {

            $params = $matches[0];

            for($i = 0; $i < count($params); $i++) {
                $params[$i] = mb_substr($params[$i], 1, strlen($params[$i]) - 2);
            }

            $uri = preg_replace($dynamiqueRouteRegex, "([^/\s])+", $uri);
        }        

        $this->routes[] = [
            'uri' => "#^" . $uri . "$#i",
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
            'params' => $params
        ];

        return $this;
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