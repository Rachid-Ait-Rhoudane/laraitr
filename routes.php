<?php

use http\Controllers\HomeController;

$router->get('/', [HomeController::class, 'index']);

$router->get('/about', [HomeController::class, 'about']);

$router->get('/contact', [HomeController::class, 'contact']);

$router->get('/register', 'registration/create.php')->only('guest');

$router->post('/register', 'registration/store.php');

$router->get('/login', 'session/create.php');

$router->post('/login', 'session/store.php');

$router->delete('/logout', 'session/destroy.php');

$router->get('/notes', 'notes/index.php')->only('auth');

$router->get('/note', 'notes/show.php');

$router->get('/notes/create', 'notes/create.php');

$router->post('/notes/create', 'notes/store.php');

$router->get('/notes/edit', 'notes/edit.php');

$router->patch('/notes/edit', 'notes/update.php');

$router->delete('/note', 'notes/destroy.php');