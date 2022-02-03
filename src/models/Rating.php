<?php

require_once 'Values.php';

class Rating extends Values
{
    private $idComment;

    public function __construct($idComment,$general, $dust, $green, $smoke, $intensity, $strength, $addons)
    {
        parent::__construct($general,$dust,$green,$smoke,$intensity,$strength,$addons);
        $this->idComment = $idComment;
    }

    public function getIdComment()
    {
        return $this->idComment;
    }

    public function setIdComment($idComment)
    {
        $this->idComment = $idComment;
    }

}