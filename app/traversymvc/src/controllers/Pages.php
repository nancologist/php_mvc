<?php

class Pages {
    public function __construct() {

    }

    public function index() {}

    public function about($id) {
        echo 'Your ID is: ' . $id;
    }
}
