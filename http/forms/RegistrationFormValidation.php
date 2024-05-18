<?php

namespace http\forms;

use core\validation\Validator;
use core\validation\FormValidation;

class RegistrationFormValidation extends FormValidation {

    protected function apply() {

        if(!Validator::string($this->attributes['firstname'], 3, 255)) {
            $this->errors['firstname'] = 'The firstname field must be at least 3 and no more than 255 characters';
        }

        if(!Validator::string($this->attributes['lastname'], 3, 255)) {
            $this->errors['lastname'] = 'The lastname field must be at least 3 and no more than 255 characters';
        }

        if(!Validator::string($this->attributes['username'], 3, 255)) {
            $this->errors['username'] = 'The username field must be at least 3 and no more than 255 characters';
        }

        if(!Validator::unique('users','username', $this->attributes['username'])) {
            $this->errors['username'] = 'a user with this username is already exists';
        }

        if(!Validator::email($this->attributes['email'])) {
            $this->errors['email'] = 'enter a valid email address';
        }

        if(!Validator::unique('users','email', $this->attributes['email'])) {
            $this->errors['email'] = 'a user with this email is already exists';
        }
        
        if(!Validator::string($this->attributes['password'], 9, 255)) {
            $this->errors['password'] = 'the password must be at least 9 and no more than 255 characters';
        }

        if(!Validator::password_match($this->attributes['password'], $this->attributes['confirm_password'])) {
            $this->errors['confirm_password'] = 'password confirmation failed';
        }
    }
}