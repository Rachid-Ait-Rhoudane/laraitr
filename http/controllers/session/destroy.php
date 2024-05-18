<?php

use core\Authenticator;

$auth = new Authenticator();

$auth->logout();

redirect('/');