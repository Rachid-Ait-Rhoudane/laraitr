<?php

use http\Controllers\HomeController;
use http\Controllers\SessionController;
use http\Controllers\RegistrationController;

$router->get('/', [HomeController::class, 'index']);

$router->get('/about', [HomeController::class, 'about']);

$router->get('/contact', [HomeController::class, 'contact']);

$router->get('/register', [RegistrationController::class, 'create'])->only('guest');

$router->post('/register', [RegistrationController::class, 'store'])->only('guest');

$router->get('/login', [SessionController::class, 'create'])->only('guest');

$router->post('/login', [SessionController::class, 'store'])->only('guest');

$router->delete('/logout', [SessionController::class, 'destroy'])->only('auth');

$router->get('/notes', 'notes/index.php')->only('auth');

$router->get('/note', 'notes/show.php')->only('auth');

$router->get('/notes/create', 'notes/create.php')->only('auth');

$router->post('/notes/create', 'notes/store.php')->only('auth');

$router->get('/notes/edit', 'notes/edit.php')->only('auth');

$router->patch('/notes/edit', 'notes/update.php')->only('auth');

$router->delete('/note', 'notes/destroy.php')->only('auth');