<?php
require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController{

    public function login(){

        $user = new User('admin@email.com', 'admin', 'admin');

        if(!$this->isPost()){
            return $this->login('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->getEmail() !== $email){
            // return $this->render('login', ['message'=>['wrong email']]);
            die('wrong email');
        }

        if($user->getPassword() !== $password){
           // return $this->render('login', ['message'=>['wrong password']]);
            die('wrong pswd');
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/rank");
    }


}