<?php

session_start();

use core\Router;
use core\Session;
use core\validation\ValidationException;

const BASE_PATH = __DIR__ . "/../";

require_once BASE_PATH . "core/functions.php";

spl_autoload_register(function($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, base_path("{$class}.php"));
    require_once $class;
});

require base_path("bootstrap.php");

$router = new Router();

require_once base_path("routes.php");

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['__method'] ?? $_SERVER['REQUEST_METHOD'];

try {

    $router->route($uri, $method);

} catch(ValidationException $e) {

    Session::flash('errors', $e->errors);

    Session::flash('oldValues', $e->oldValues);

    return redirect($router->previousURL());
}

Session::unflash();