<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::post('login', 'SecurityController');
Router::post('registration', 'SecurityController');
Router::get('rank', 'DefaultController');
Router::get('notFound','DefaultController');
Router::get('user_ratings','DefaultController');
Router::run($path);