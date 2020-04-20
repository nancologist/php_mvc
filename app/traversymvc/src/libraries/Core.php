<?php

/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
*/

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
        // print_r($this->getUrl());

        $url = $this->getUrl();

        $controllerPath = '../src/controllers/' . ucwords($url[0]) . '.php';
        if (file_exists($controllerPath)) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        require_once '../src/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;
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