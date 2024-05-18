<?php

namespace core\middleware;

class Guest {

    public function handle() {

        if(isset($_SESSION['user'])) {
            header('location: /');
            die();
        }
    }
}