<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render('rank');
    }
    public function loadgin()
    {
        $this->render('login');
    }

    public function rank(){
        $this->render('rank');
    }

    public function notFound(){
        $this->render('notFound');
    }

}