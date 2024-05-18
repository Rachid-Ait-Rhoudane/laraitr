<?php

use core\App;
use core\Validator;
use core\Database;

$db = App::resolve(Database::class);

$id = $_POST['id'];

$body = $_POST['body'];

$currentUserID = 1;

$errors = [];

$note = $db->query('select * from notes where id = :id', [
    ':id' => $id
])->findOrFail();

authorize($note['user_id'] == $currentUserID);

if(!Validator::string($body, 25, 255)) {
    $errors['body'] = 'The body field must be at least 25 and no more than 255 characters';
}

if(!Validator::required($body)) {
    $errors['body'] = 'The body field is required';
}

if(!empty($errors)) {

    return view('notes/edit', [
        'heading' => 'edit note',
        'errors' => $errors,
        'note' => $note,
        'oldValue' => $body
    ]);
}

$db->query("update notes set body = :body where id = :id", [
    ":body" => $body,
    ":id" => $id
]);

header("location: /notes");

die();

