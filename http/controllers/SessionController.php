<?php

namespace http\controllers;

use core\Session;
use core\Authenticator;
use http\forms\LoginFormValidation;

class SessionController {

    public function create() {

        $errors = Session::get('errors') ?? [];

        return view('session/create', [
            'heading' => 'login to your account',
            'errors' => $errors
        ]);
    }

    public function store() {

        $form = LoginFormValidation::validate($attributes = [
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ]);
        
        $signedIn = (new Authenticator)->attempt($attributes['email'], $attributes['password']);
        
        if(!$signedIn) {
            $form->setError('login_error', 'incorrect email or password')->throw();
        }
        
        return redirect('/');
    }

    public function destroy() {

        $auth = new Authenticator();

        $auth->logout();

        return redirect('/');
    } 
}