<?php
require_once 'AppController.php';
require_once __DIR__.'/../models/Yerba.php';
require_once __DIR__.'/../models/Origin.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Comment.php';
require_once __DIR__.'/../models/Rating.php';
require_once __DIR__.'/../repository/YerbaRepository.php';
require_once __DIR__.'/../repository/CommentsRepository.php';


class CommentsController extends AppController
{

    private $yerbaRepository;
    private $commentsRepository;
    private $idYerba;

    public function __construct(){
        parent::__construct();
        $this->yerbaRepository = new YerbaRepository();
        $this->commentsRepository = new CommentsRepository();
    }


    private function validateInputs( $general ,$dust,$green,$smoke, $intensity, $strength, $addons, $text){
        if( !isset($general)){
            return false;
        }
        if( !isset($green)){
            return false;
        }
        if( !isset($dust)){
            return false;
        }
        if( !isset($smoke)){
            return false;
        }
        if( !isset($intensity)){
            return false;
        }
        if( !isset($strength)){
            return false;
        }
        if( !isset($addons)){
            return false;
        }
        if( !isset($text)){
            return false;
        }
        return true;
    }

    public function addOpinion(){
        session_start();
        $url = "http://$_SERVER[HTTP_HOST]";
        if(!isset($_GET['id'])){
            header("Location: {$url}/rank");
            die();
        }

        if(!isset($_SESSION['user'])){
            header("Location: {$url}/rank");
            die();
        }
        $idUser = unserialize($_SESSION['user'])->getId();



        if(!$this->isPost()){
            $this->idYerba = $_GET['id'];
            setcookie('idYerba',$this->idYerba,time()+1321221);
            $yerba = $this->yerbaRepository->getYerbaByID($this->idYerba);
            $origins = $this->yerbaRepository->getOriginsWithId();
            return $this->render('addOpinion', ['yerba'=>$yerba, 'origins'=>$origins]);
        }

        $this->idYerba = $_COOKIE['idYerba'];
        if($this->commentsRepository->hasUserCommentedYerba($this->idYerba,$idUser)){
            header("Location: {$url}/editOpinion?id=".$this->idYerba);
            die();
        }



        $general = $_POST['general'];
        $dust = $_POST['dust'];
        $smoke = $_POST['smoke'];
        $green = $_POST['green'];
        $intensity = $_POST['intensity'];
        $strength = $_POST['strength'];
        $addons = $_POST['addons'];
        $text = $_POST['commentText'];
        $this->idYerba = $_COOKIE['idYerba'];
        if(!$this->validateInputs($general ,$dust,$green,$smoke, $intensity, $strength, $addons, $text)){
            header("Location: {$url}/yerba?id=".$this->idYerba);
            die();
        }
        $this->commentsRepository->addComment($this->idYerba,$idUser,$text,$general,$dust,$green,$smoke,$intensity,$strength,$addons);
        header("Location: {$url}/yerba?id=".$this->idYerba);
    }

    public function editOpinion(){
        session_start();
        $url = "http://$_SERVER[HTTP_HOST]";

        if(!isset($_GET['id'])){
            header("Location: {$url}/rank");
            die();
        }

        if(!isset($_SESSION['user'])){
            header("Location: {$url}/rank");
            die();
        }

        $idUser = unserialize($_SESSION['user'])->getId();
        if(!$this->isPost()){
            $opinionId = $_GET['id'];
            setcookie('idOpinion',$opinionId,time()+1321221);
            $opinion = $this->commentsRepository->getById($opinionId);
            $yerba = $this->yerbaRepository->getYerbaByID($opinion['c']->getIdYerba());
            $origins = $this->yerbaRepository->getOriginsWithId();
            return $this->render('ediOpinion', ['yerba'=>$yerba, 'origins'=>$origins, 'opinion' =>$opinion]);
        }


        $general = $_POST['general'];
        $dust = $_POST['dust'];
        $smoke = $_POST['smoke'];
        $green = $_POST['green'];
        $intensity = $_POST['intensity'];
        $strength = $_POST['strength'];
        $addons = $_POST['addons'];
        $text = $_POST['commentText'];
        $opinionId = $_COOKIE['idOpinion'];

        if(!$this->validateInputs($general ,$dust,$green,$smoke, $intensity, $strength, $addons, $text)){
            header("Location: {$url}/userRatings");
            die();
        }
        $oldOpinion = $this->commentsRepository->getById($opinionId);
        $this->commentsRepository->editComment($oldOpinion,$general ,$dust,$green,$smoke, $intensity, $strength, $addons, $text);
        header("Location: {$url}/userRatings");
    }

    public function deleteOpinion(){
        session_start();
        $url = "http://$_SERVER[HTTP_HOST]";

        if(!isset($_GET['id'])){
            header("Location: {$url}/rank");
            die();
        }

        if(!isset($_SESSION['user'])){
            header("Location: {$url}/rank");
            die();
        }
        $id = $_GET['id'];
        $idUser = unserialize($_SESSION['user'])->getId();

        $opinion = $this->commentsRepository->getById($id);
        if($opinion['c']->getIdUser() != $idUser){
            header("Location: {$url}/rank");
            die();
        }
        $this->commentsRepository->deleteComment($opinion);
        header("Location: {$url}/userRatings");

    }

}