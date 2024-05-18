<?php

use core\App;
use core\Database;

$db = App::resolve(Database::class);

$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

$currentUserID = 1;

authorize($note['user_id'] == $currentUserID);

view('notes/show', [
    'heading' => 'note',
    'note' => $note
]);


