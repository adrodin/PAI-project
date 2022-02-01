<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::post('login', 'SecurityController');
Router::get('logout', 'SecurityController');
Router::post('registration', 'SecurityController');
Router::get('rank', 'RankController');
Router::get('notFound','DefaultController');
Router::get('userRatings','UserController');
Router::get('settings','DefaultController');
Router::post('changePassword', 'SecurityController');
Router::post('changeAvatar', 'SecurityController');
Router::get('newYerba', 'YerbaController');
Router::get('yerba', 'YerbaController');
Router::post('addOpinion', 'CommentsController');
Router::post('editOpinion', 'CommentsController');
Router::post('deleteOpinion', 'CommentsController');
Router::run($path);