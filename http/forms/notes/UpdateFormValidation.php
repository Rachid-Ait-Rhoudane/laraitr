<?php

namespace http\forms\notes;

use core\validation\Validator;
use core\validation\FormValidation;

class UpdateFormValidation extends FormValidation {

    protected function apply() {

        if(!Validator::string($this->attributes['body'], 25, 255)) {
            $this->errors['body'] = 'The body field must be between 25 and 255 characters';
        }

        if(!Validator::required($this->attributes['body'])) {
            $this->errors['body'] = 'The body field is required';
        }
    }
}