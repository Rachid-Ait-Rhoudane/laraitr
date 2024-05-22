<?php

namespace http\controllers;

use models\User;
use core\Authenticator;
use http\forms\RegistrationFormValidation;

class RegistrationController {

    public function create() {

        return view('registration/create', [
            'heading' => 'register now'
        ]);        
    }

    public function store() {

        $form = RegistrationFormValidation::validate([
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'confirm_password' => $_POST['confirm_password'],
        ]);

        $user = (new User)->create([
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        ])->where('email', '=', $_POST['email'])->findOrFail();

        (new Authenticator)->login($user);

        return redirect('/');
    }
}