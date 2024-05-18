<?php

namespace http\forms;

use core\validation\Validator;
use core\Validation\FormValidation;

class LoginFormValidation extends FormValidation{

    protected function apply() {

        if(!Validator::email($this->attributes['email'])) {
            $this->errors['email'] = 'enter a valid email address';
        }
        
        if(!Validator::string($this->attributes['password'], 9, 255)) {
            $this->errors['password'] = 'the password must be at least 9 and no more than 255 characters';
        }
    }
}