<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render('login');
    }
    public function login()
    {
        $this->render('login');
    }

    public function registration(){
        $this->render('registration');
    }

    public function rank(){
        $this->render('rank');
    }

    public function notFound(){
        $this->render('notFound');
    }
    public function user_ratings(){
        $this->render('user_ratings');
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