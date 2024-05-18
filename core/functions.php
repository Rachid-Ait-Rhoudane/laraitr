<?php

use core\Session;
use core\Response;

function dd($value) {
    
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function urlIs($uri) {

    return parse_url($_SERVER['REQUEST_URI'])['path'] === $uri;
}

function abort($code = Response::NOT_FOUND) {

    http_response_code($code);
    if(file_exists(base_path("views/{$code}.view.php"))) {
        view("{$code}");
    }
    die();
}

function authorize($condition, $status = Response::FORBIDDEN) {
    
    if(!$condition) {
        abort($status);
    }
}

function base_path($path) {

    return BASE_PATH . $path;
}

function view($view, $params = []) {

    extract($params);
    require base_path('/views/' . $view . '.view.php');
}

function redirect($path) {

    header("location: {$path}");
    die();
}

function old($key, $default = '') {

    return Session::get('oldValues')[$key] ?? $default;
}