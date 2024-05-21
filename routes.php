<?php

use http\Controllers\HomeController;
use http\Controllers\SessionController;
use http\Controllers\RegistrationController;
use http\Controllers\NoteController;

$router->get('/', [HomeController::class, 'index']);

$router->get('/about', [HomeController::class, 'about']);

$router->get('/contact', [HomeController::class, 'contact']);

$router->get('/register', [RegistrationController::class, 'create'])->only('guest');

$router->post('/register', [RegistrationController::class, 'store'])->only('guest');

$router->get('/login', [SessionController::class, 'create'])->only('guest');

$router->post('/login', [SessionController::class, 'store'])->only('guest');

$router->delete('/logout', [SessionController::class, 'destroy'])->only('auth');

$router->get('/notes', [NoteController::class, 'index'])->only('auth');

$router->get('/notes/show/{id}', [NoteController::class, 'show'])->only('auth');

$router->get('/notes/create', [NoteController::class, 'create'])->only('auth');

$router->post('/notes/create', [NoteController::class, 'store'])->only('auth');

$router->get('/notes/edit/{id}', [NoteController::class, 'edit'])->only('auth');

$router->patch('/notes/update', [NoteController::class, 'update'])->only('auth');

$router->delete('/note', [NoteController::class, 'destroy'])->only('auth');