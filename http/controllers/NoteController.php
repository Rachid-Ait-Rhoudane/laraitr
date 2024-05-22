<?php

namespace http\controllers;

use models\Note;
use core\Session;
use http\forms\notes\StoreFormValidation;
use http\forms\notes\UpdateFormValidation;

class NoteController {

    public function index() {

        $notes = (new Note)->all();

        return view('notes/index', [
            'heading' => 'my notes',
            'notes' => $notes 
        ]);
    }

    public function show($id) {

        $note = (new Note)->findOrFail($id);

        $currentUserID = Session::user('id');

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

        $currentUserID = Session::user('id');

        (new Note)->create([
            'user_id' => $currentUserID,
            'body' => $_POST['body']
        ]);

        return redirect('/notes');
    }

    public function edit($id) {

        $note = (new Note)->findOrFail($id);
            
        $currentUserID = Session::user('id');

        authorize($note['user_id'] == $currentUserID);

        return view('notes/edit', [
            'heading' => 'edit note',
            'note' => $note
        ]);
    }

    public function update() {

        $form = UpdateFormValidation::validate([
            'body' => $_POST['body']
        ]);

        $note = (new Note)->findOrFail($_POST['id']);

        $currentUserID = Session::user('id');

        authorize($note['user_id'] == $currentUserID);

        (new Note)->update($note['id'], [
            'body' => $_POST['body']
        ]);

        return redirect('/notes');
    }

    public function destroy() {

        $note = (new Note)->findOrFail($_POST['id']);

        $currentUserID = Session::user('id');

        authorize($note['user_id'] == $currentUserID);

        (new Note)->destroy($note['id']);

        return redirect('/notes');
    }
}