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

            if($route['uri'] === $uri && $route['method'] === strtoupper($method)) {

                Middleware::resolve($route['middleware'] ?? false);

                if(is_callable($route['controller'])) {

                    return call_user_func($route['controller']);
                }

                return call_user_func([new $route['controller'][0], $route['controller'][1]]);
            }
        }
        
        $this->abort();
    }

    private function add($uri, $controller, $method) {

        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
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