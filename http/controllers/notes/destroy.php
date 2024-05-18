<?php

use core\App;
use core\Database;

$db = App::resolve(Database::class);

$id = $_POST['id'];

$currentUserID = 1;

$note = $db->query('select * from notes where id = :id', [
    ':id' => $id
])->findOrFail();

authorize($note['user_id'] == $currentUserID);

$db->query('delete from notes where id = :id', [
    ':id' => $id
]);

header('location: /notes');

die();