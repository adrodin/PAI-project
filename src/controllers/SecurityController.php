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
        session_start();
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
        if(!password_verify($password,$user->getPassword())){
           // return $this->render('login', ['message'=>['wrong password']]);
            die('wrong pswd');
        }

        $_SESSION["user"] = serialize($user);

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

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            //TODO invalid email
            die("Invalid email");
        }

        if ($password !== $confirmedPassword){
            //TODO
            die("Pasword != confPassword");
        }
        //$password = hash('sha256',$password);
        $password = password_hash($password,PASSWORD_ARGON2ID);
        $user = new User($email,$password,$name);
        $user->setAvatar('av');
        $this->userRepository->addUser($user);

        //TODO succesfully registrated info
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/login");
    }

    public function logout(){
        session_start();
        session_unset();
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/rank");
    }


}