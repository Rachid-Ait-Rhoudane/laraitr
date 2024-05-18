<?php

namespace http\controllers;

class HomeController {

    public function index() {

        return view('index', [
            'heading' => 'home'
        ]);
    }

    public function about() {

        return view('about', [
            'heading' => 'about us'
        ]);
    }

    public function contact() {

        return view('contact', [
            'heading' => 'contact us'
        ]);
    }
}