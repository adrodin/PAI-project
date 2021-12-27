<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $this->render('rank');
    }
    public function login()
    {
        $this->render('login');
    }

    public function rank(){
        $this->render('rank');
    }

}