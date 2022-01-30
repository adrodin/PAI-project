<?php
require_once 'AppController.php';
require_once __DIR__.'/../models/Yerba.php';
require_once __DIR__.'/../models/Origin.php';
require_once __DIR__.'/../models/Yerba.php';
require_once __DIR__.'/../repository/YerbaRepository.php';
require_once __DIR__.'/../repository/CommentsRepository.php';

class YerbaController extends AppController{

    const MAX_YERBA_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/yerba/';

    private $yerbaRepository;
    private $commentsRepository;
    private $message;
    public function __construct(){
        parent::__construct();
        $this->yerbaRepository = new YerbaRepository();
        $this->commentsRepository = new CommentsRepository();
    }

    private function validateFile($file){
        if($file['size'] > self::MAX_YERBA_SIZE){
            $this->message[] = "Zbyt duży plik";
            return false;
        }
        if (isset($file['type']) && !in_array($file['type'],self::SUPPORTED_TYPES)){
            $this->message[] = "Zły typ pliku";
            return false;
        }
        return true;
    }

    private function validateInputs($name, $origin, $type, $description){

        if(!isset($name)){

            $this->message[] = 'Brak nazwy';
            return false;
        }
        if(!isset($origin)){
            $this->message[] = 'Brak pochodzenia';
            return false;
        }
        if(!isset($description)){
            $this->message[] = 'Brak opisu';
            return false;
        }
        if(!isset($type)){
            $this->message[] = 'Brak typu';
            return false;
        }

        return true;
    }

    public function newYerba(){
        session_start();
        $url = "http://$_SERVER[HTTP_HOST]";
        if(!isset($_SESSION['user'])){
            header("Location: {$url}/rank");
        }
        if(unserialize($_SESSION['user'])->getId() < 2){
            header("Location: {$url}/rank");
        }

        $types = $this->yerbaRepository->getTypes();
        $origins = $this->yerbaRepository->getOrigins();

        if (!$this->isPost()){
            return $this->render('newYerba',['origins'=>$origins, 'types'=>$types]);
        }

        $name = $_POST['name'];
        $origin = $_POST['origin'];
        $type = $_POST['type'];
        $addons = $_POST['addons'];
        $description = $_POST['description'];
        $photo = $_POST['photo'];
        $addons = explode(", ",$addons);

        if(is_uploaded_file($_FILES['file']['tmp_name']) && $this->validateFile($_FILES['file']) && $this->validateInputs($name,$origin,$type,$description)){
            move_uploaded_file($_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );
            $yerba = new Yerba($origin,$type,$name,$description,$_FILES['file']['name']);
            $this->yerbaRepository->addYerba($yerba,$addons);
            $this->message[] = "Pomyślnie dodano yerbe";
            //$this->userRepository->changeAvatar($_FILES['file']['name'],unserialize($_SESSION['user'])->getId());
            //$this->message[] = "Pomyślnie zmieniono avatar";
        }
        return $this->render('newYerba',['message'=>[$this->message[0]], 'origins'=>$origins, 'types'=>$types]);
    }


    public function yerba()
    {
        $id = $_GET['id'];
        $yerba = $this->yerbaRepository->getYerbaByID($id);
        $origins = $this->yerbaRepository->getOriginsWithId();
        $comments = $this->commentsRepository->getCommentsWithRatesByYerbaId($id);
        return $this->render('yerba', ['yerba'=>$yerba, 'comments'=>$comments, 'origins'=>$origins]);
    }


}