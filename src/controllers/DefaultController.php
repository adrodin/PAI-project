<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render('login');
    }

    public function notFound(){
        $this->render('notFound');
    }

    public function settings(){
        session_start();
        if(isset($_SESSION['user'])){
            return $this->render('settings');
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/rank");
    }



}