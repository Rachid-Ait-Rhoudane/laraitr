<?php

use core\App;
use core\Database;

$id = $_GET['id'];

$db = App::resolve(Database::class);

$currentUserID = 1;

$note = $db->query("select * from notes where id = :id", [
    ":id" => $id
])->findOrFail();

authorize($note['user_id'] == $currentUserID);

view('notes/edit', [
    'heading' => 'edit note',
    'note' => $note
]);