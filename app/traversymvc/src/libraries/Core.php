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
        $this->getUrl();
    }

    public function getUrl(): void {
        echo $_GET['url'];
    }
}