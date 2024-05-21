<?php

namespace http\controllers;

use core\App;
use core\Database;
use http\forms\notes\StoreFormValidation;
use http\forms\notes\UpdateFormValidation;

class NoteController {

    public function index() {

        $db = App::resolve(Database::class);

        $currentUserID = 1;

        $notes = $db->query('select * from notes where user_id = :user', [
            ":user" => $currentUserID
        ])->get();

        return view('notes/index', [
            'heading' => 'my notes',
            'notes' => $notes 
        ]);
    }

    public function show($id) {

        $db = App::resolve(Database::class);

        $note = $db->query('select * from notes where id = :id', [
            'id' => $id
        ])->findOrFail();

        $currentUserID = 1;

        authorize($note['user_id'] == $currentUserID);

        return view('notes/show', [
            'heading' => 'note',
            'note' => $note
        ]);
    }

    public function create() {

        return view('notes/create', [
            'heading' => 'create new note'
        ]);
    }

    public function store() {

        $form = StoreFormValidation::validate([
            'body' => $_POST['body']
        ]);

        $db = App::resolve(Database::class);

        $currentUserID = 1;

        $db->query("insert into notes(body, user_id) values(:body,:user)", [
            ":user" => $currentUserID,
            ":body" => strip_tags($_POST['body'])
        ]);

        return redirect('/notes');
    }

    public function edit($id) {

        $db = App::resolve(Database::class);

        $currentUserID = 1;

        $note = $db->query("select * from notes where id = :id", [
            ":id" => $id
        ])->findOrFail();

        authorize($note['user_id'] == $currentUserID);

        return view('notes/edit', [
            'heading' => 'edit note',
            'note' => $note
        ]);
    }

    public function update() {

        $db = App::resolve(Database::class);

        $id = $_POST['id'];

        $body = $_POST['body'];

        $form = UpdateFormValidation::validate([
            'body' => $body
        ]);

        $currentUserID = 1;

        $note = $db->query('select * from notes where id = :id', [
            ':id' => $id
        ])->findOrFail();

        authorize($note['user_id'] == $currentUserID);

        $db->query("update notes set body = :body where id = :id", [
            ":body" => $body,
            ":id" => $id
        ]);

        return redirect('/notes');
    }

    public function destroy() {

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

        return redirect('/notes');
    }
}