<?php

use core\App;
use core\Database;

$db = App::resolve(Database::class);

$currentUserID = 1;

$notes = $db->query('select * from notes where user_id = :user', [
    ":user" => $currentUserID
])->get();

view('notes/index', [
    'heading' => 'my notes',
    'notes' => $notes 
]);