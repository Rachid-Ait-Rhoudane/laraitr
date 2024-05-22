<?php

namespace core;

class Authenticator {

    public function attempt($email, $password) {

        $user = (App::resolve(Database::class))->query('select * from users where email = :email', [
            ':email' => $email
        ])->find();
        
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
    
        unset($_SESSION);
        session_destroy();
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}