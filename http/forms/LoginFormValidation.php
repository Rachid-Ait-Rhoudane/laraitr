<?php

namespace http\forms;

use core\Validator;
use core\ValidationException;

class LoginFormValidation {
    
    private $errors = [];

    public function __construct(public array $attributes) {

        if(!Validator::email($this->attributes['email'])) {
            $this->errors['email'] = 'enter a valid email address';
        }
        
        if(!Validator::string($this->attributes['password'], 9, 255)) {
            $this->errors['password'] = 'the password must be at least 9 and no more than 255 characters';
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