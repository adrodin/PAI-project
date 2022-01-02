<?php
require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController{

    private $userRepository;

    public function __construct(){
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login(){

        //$user = new User('admin@email.com', 'admin', 'admin');




        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUser($email);

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

    public function registration() {
        //die('ez');
        //$this->render('registration');
        if(!$this->isPost()){
            return $this->render('registration');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];


        if ($password !== $confirmedPassword){
            //TODO
            die("Pasword != confPassword");
        }
        $password = hash('sha256',$password);
        $user = new User($email,$password,$name);
        $user->setAvatar('av');
        $this->userRepository->addUser($user);

        //TODO succesfully registrated info
        return $this->render('login');
    }


}