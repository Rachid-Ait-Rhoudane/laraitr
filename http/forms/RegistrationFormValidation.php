<?php

namespace http\forms;

use core\Validator;
use core\ValidationException;

class RegistrationFormValidation {
    
    private $errors = [];

    public function __construct(public array $attributes) {

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

    public static function validate($attributes) {

       $instance = new static($attributes);

       return $instance->failed() ?  $instance->throw() : $instance;
    }

    public function throw() {

        return ValidationException::throw($this->getErrors(), $this->attributes);
    }

    public function failed() {

        return count($this->errors);
    }

    public function getErrors() {

        return $this->errors;

    }

    public function setError($key, $message) {
        
        $this->errors[$key] = $message;

        return $this;
    }
}