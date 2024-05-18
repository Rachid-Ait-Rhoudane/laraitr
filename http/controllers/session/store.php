<?php

use core\Authenticator;
use http\forms\LoginFormValidation;


$form = LoginFormValidation::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$signedIn = (new Authenticator)->attempt($attributes['email'], $attributes['password']);

if(!$signedIn) {
    $form->setError('login_error', 'incorrect email or password')->throw();
}

return redirect('/');
