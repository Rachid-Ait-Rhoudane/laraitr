<?php

use core\App;
use core\Database;
use core\Validator;

$db = App::resolve(Database::class);

$errors = [];

if(!Validator::string($_POST['firstname'], 3, 255)) {
    $errors['firstname'] = 'The firstname field must be at least 3 and no more than 255 characters';
}

if(!Validator::string($_POST['lastname'], 3, 255)) {
    $errors['lastname'] = 'The lastname field must be at least 3 and no more than 255 characters';
}

if(!Validator::string($_POST['username'], 3, 255)) {
    $errors['username'] = 'The username field must be at least 3 and no more than 255 characters';
}

$user = $db->query("select * from users where username = :username", [
    ':username' => $_POST['username']
])->find();

if($user) {
    $errors['username'] = 'a user with this username is already exists';
}

if(!Validator::string($_POST['password'], 9, 255)) {
    $errors['password'] = 'The password field must be at least 3 and no more than 255 characters';
}

if(!Validator::email($_POST['email'])) {
    $errors['email'] = 'enter a valid email';
}

$user = $db->query("select * from users where email = :email", [
    ':email' => $_POST['email']
])->find();

if($user) {
    $errors['email'] = 'a user with this email is already exists';
}

if(!Validator::password_match($_POST['password'], $_POST['confirm_password'])) {
    $errors['confirm_password'] = 'password confirmation failed';
}

if(count($errors)) {

    return view('registration/create', [
        'heading' => 'register now',
        'errors' => $errors,
        'oldValues' => $_POST
    ]);
}

$db->query('insert into users(firstname, lastname, username, email, password) values(:firstname, :lastname, :username, :email, :password)', [
    ':firstname' => $_POST['firstname'],
    ':lastname' => $_POST['lastname'],
    ':username' => $_POST['username'],
    ':email' => $_POST['email'],
    ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
]);

login($user);

header('location: /');

die();