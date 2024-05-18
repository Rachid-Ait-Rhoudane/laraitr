<?php

namespace core\validation;

class ValidationException extends \Exception {

    public readonly array $errors;

    public readonly array $oldValues;

    public static function throw($errors, $oldValues) {

        $instance = new static;

        // dd($instance);

        $instance->errors = $errors;

        $instance->oldValues = $oldValues;

        throw $instance;
    }
}