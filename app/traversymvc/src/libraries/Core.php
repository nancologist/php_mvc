<?php

/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
*/

class Core {
    protected string $currentController = 'Pages';
    protected string $currentMethod = 'index';
    protected array $params = [];

    public function __construct() {
        print_r($this->getUrl());
    }

    public function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}