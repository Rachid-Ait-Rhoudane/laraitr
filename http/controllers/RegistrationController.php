<?php

namespace http\controllers;

use core\App;
use core\Database;
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
        
        $db = App::resolve(Database::class);

        $db->query('insert into users(firstname, lastname, username, email, password) values(:firstname, :lastname, :username, :email, :password)', [
            ':firstname' => $_POST['firstname'],
            ':lastname' => $_POST['lastname'],
            ':username' => $_POST['username'],
            ':email' => $_POST['email'],
            ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        ]);

        (new Authenticator)->login([
            'username' => $_POST['username'],
            'email' => $_POST['email']
        ]);

        return redirect('/');
    }
}