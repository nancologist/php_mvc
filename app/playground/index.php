<?php
$url = rtrim($_GET['url'], '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);
print_r($url)
?>