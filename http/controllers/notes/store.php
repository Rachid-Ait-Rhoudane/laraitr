<?php

use core\App;
use core\Database;
use core\Validator;

$db = App::resolve(Database::class);

$currentUserID = 1;

$errors = [];

if(!Validator::string($_POST['body'], 25, 255)) {
    $errors['body'] = 'The body field must be between 25 and 255 characters';
}

if(!Validator::required($_POST['body'])) {
    $errors['body'] = 'The body field is required';
}

if(!empty($errors)) {
    
    view('notes/create', [
        'heading' => 'create new note',
        'errors' => $errors,
        'oldValue' => $_POST['body']
    ]);
}

$db->query("insert into notes(body, user_id) values(:body,:user)", [
    ":user" => $currentUserID,
    ":body" => strip_tags($_POST['body'])
]);

header("location: /notes");

die();