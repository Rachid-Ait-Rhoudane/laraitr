<?php

use core\Session;

$errors = Session::get('errors') ?? [];

return view('session/create', [
    'heading' => 'login to your account',
    'errors' => $errors
]);