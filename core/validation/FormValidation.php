<?php

namespace core\validation;

abstract class FormValidation {

    protected $errors = [];

    protected $attributes;

    abstract protected function apply();

    public static function validate($attributes) {

       $instance = new static();

       $instance->attributes = $attributes;

       $instance->apply();

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