<?php

class RankController extends AppController{

    private $yerbaRepository;

    public function __construct(){
        parent::__construct();
        $this->yerbaRepository = new YerbaRepository();
    }


    public function rank(){

        $yerba = $this->yerbaRepository->getAllWithAverageRatings();
        $origins = $this->yerbaRepository->getOriginsWithId();

        return $this->render('rank',['yerba'=>$yerba, 'origins'=>$origins]);
    }
}