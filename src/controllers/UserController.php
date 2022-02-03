<?php
require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Yerba.php';
require_once __DIR__.'/../models/Comment.php';
require_once __DIR__.'/../models/Rating.php';
require_once __DIR__.'/../repository/CommentsRepository.php';
require_once __DIR__.'/../repository/YerbaRepository.php';

class UserController extends AppController
{

    private $yerbaRepository;
    private $commentsRepository;

    public function __construct(){
        parent::__construct();
        $this->yerbaRepository = new YerbaRepository();
        $this->commentsRepository = new CommentsRepository();
    }

    public function userRatings(){
        session_start();
        $url = "http://$_SERVER[HTTP_HOST]";
        if(!isset($_SESSION['user'])){
            header("Location: {$url}/rank");
        }
        $userId = unserialize($_SESSION['user'])->getId();
        $userRatings = $this->commentsRepository->getCommentsByUserId($userId);
        $yerba = $this->yerbaRepository->getAll();
        $origins = $this->yerbaRepository->getOriginsWithId();
        return $this->render('userRatings',['yerba'=>$yerba, 'origins'=>$origins,'ratings' =>$userRatings]);

    }

}