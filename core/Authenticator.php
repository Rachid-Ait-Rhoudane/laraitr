<?php

namespace core;

use models\User;

class Authenticator {

    public function attempt($email, $password) {

        $user = (new User)->where('email', '=', $email)->find();
        
        if(!password_verify($password, $user['password'] ?? '')) {
          return false;      
        }

        $this->login($user);

        return true;
    }

    public function login($user) {

        session_regenerate_id(true);
        
        Session::put('user', [
            'id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email']
        ]);
    }
    
    public function logout() {
    
        Session::destroy();
    }
}