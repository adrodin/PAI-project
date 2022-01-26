<?php
require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController{

    const MAX_AVATAR_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/avatars/';


    private $message = [];
    private $userRepository;

    public function __construct(){
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login(){
        session_start();
        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUserByEmail($email);

        if(!$user){
            return $this->render('login', ['message'=>['Użytkownik nie istnieje']]);
        }

        if ($user->getEmail() !== $email){
             return $this->render('login', ['message'=>['Użytkownik nie istnieje']]);
        }
        if(!password_verify($password,$user->getPassword())){
            return $this->render('login', ['message'=>['Użytkownik nie istnieje']]);
        }

        $_SESSION["user"] = serialize($user);
        setcookie("userId", $user->getId(), time()+90000);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/rank");
    }

    public function registration() {

        if(!$this->isPost()){
            return $this->render('registration');
        }


        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return $this->render('registration', ['message'=>['Zły email']]);
        }

        if ($password !== $confirmedPassword){
            return $this->render('registration', ['message'=>['Podane hasła są różne']]);
        }
        $password = password_hash($password,PASSWORD_ARGON2ID);
        $user = new User($email,$password,$name);
        $user->setAvatar('default.png');
        if($this->userRepository->addUser($user)){
            return $this->render('login', ['message'=>['Pomyślna rejestracja']]);
        }
        else{
            $this->render('registration', ['message'=>['Użytkownik z tą nazwą lub emailem już istnieje']]);
        }

    }

    public function logout(){
        session_start();
        session_unset();
        setcookie("userId", 1, time()-60);
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/rank");
    }


    private function validateFile($file){
        if($file['size'] > self::MAX_AVATAR_SIZE){
            $this->message[] = "Zbyt duży plik";
            return false;
        }
        if (isset($file['type']) && !in_array($file['type'],self::SUPPORTED_TYPES)){
            $this->message[] = "Zły typ pliku";
            return false;
        }
        return true;
    }

    public function changePassword(){
        if(!isset($_COOKIE['userId'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/rank");
        }

        if(!$this->isPost()){
            return $this->render('settings');
        }
        $oldPassword = $_POST['actualPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmedNewPassword = $_POST['repeatNewPassword'];

        if($confirmedNewPassword !== $newPassword){
            return $this->render('settings', ['message' => ["Nowe hasła są różne"]]);
        }

        $userPassword = $this->userRepository->getUserById($_COOKIE['userId'])->getPassword();
        if(!password_verify($oldPassword,$userPassword)){
            return $this->render('settings', ['message' => ["Błędne hasło"]]);
        }

        $password = password_hash($newPassword,PASSWORD_ARGON2ID);
        $this->userRepository->changePassword($password,$_COOKIE['userId']);
        return $this->render('settings', ['message' => ["Hasło zostało pomyślnie zmienione"]]);
    }

    public function changeAvatar(){
        $url = "http://$_SERVER[HTTP_HOST]";
        if(!isset($_COOKIE['userId'])){
            header("Location: {$url}/rank");
        }
        if (!$this->isPost()){
            header("Location: {$url}/settings");
        }

        if(is_uploaded_file($_FILES['file']['tmp_name']) && $this->validateFile($_FILES['file'])){
            move_uploaded_file($_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );
            $this->userRepository->changeAvatar($_FILES['file']['name'],$_COOKIE['userId']);
            $this->message[] = "Pomyślnie zmieniono avatar";
        }
        return $this->render('settings', ['message' => [$this->message[0]]]);
    }



}