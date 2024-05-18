<?php

namespace http\forms\notes;

use core\Validator;
use core\ValidationException;

class UpdateFormValidation {

    private $errors = [];

    public function __construct(public array $attributes) {

        if(!Validator::string($this->attributes['body'], 25, 255)) {
            $this->errors['body'] = 'The body field must be between 25 and 255 characters';
        }

        if(!Validator::required($this->attributes['body'])) {
            $this->errors['body'] = 'The body field is required';
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