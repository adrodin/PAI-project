<?php
require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController{

    public function login(){

        //$user = new User('admin@email.com', 'admin', 'admin');

        $userRepository = new UserRepository();


        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if(!$user){
            // return $this->render('login', ['message'=>['wrong email']]);
            die('no email in db');
        }

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