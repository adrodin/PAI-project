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

}