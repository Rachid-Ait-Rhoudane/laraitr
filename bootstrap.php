<?php

use core\App;
use core\Database;

App::setContainer();

App::bind(Database::class, function() {

    $config = require_once base_path("config.php");
    return Database::create($config['database']);
});