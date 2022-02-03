<?php

require_once 'Values.php';
require_once 'Rating.php';

class AverageRating extends Values
{
    private $idYerba;
    private $numOfRatings;

    public function getIdYerba()
    {
        return $this->idYerba;
    }

    public function setIdYerba($idYerba)
    {
        $this->idYerba = $idYerba;
    }

    public function getNumOfRatings()
    {
        return $this->numOfRatings;
    }

    public function setNumOfRatings($numOfRatings)
    {
        $this->numOfRatings = $numOfRatings;
    }

    public function __construct($idYerba,$numOfRatings,$general, $dust, $green, $smoke, $intensity, $strength, $addons)
    {
        parent::__construct($general,$dust,$green,$smoke,$intensity,$strength,$addons);
        $this->idYerba = $idYerba;
        $this->numOfRatings = $numOfRatings;
    }

}