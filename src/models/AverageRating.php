<?php

require_once 'Values.php';
require_once 'Rating.php';

class AverageRating extends Values
{
    private $idYerba;
    private $numOfRatings;

    /**
     * @return mixed
     */
    public function getIdYerba()
    {
        return $this->idYerba;
    }

    /**
     * @param mixed $idYerba
     */
    public function setIdYerba($idYerba)
    {
        $this->idYerba = $idYerba;
    }

    /**
     * @return mixed
     */
    public function getNumOfRatings()
    {
        return $this->numOfRatings;
    }

    /**
     * @param mixed $numOfRatings
     */
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

    public function addRate($rate){
       $this ->dust += $rate->getDust();
       $this ->general += $rate->getGeneral();
       $this ->green += $rate->getGreen();
       $this ->smoke += $rate->getSmoke();
       $this ->intensity += $rate->getIntensity();
       $this ->strength += $rate->getStrength();
       $this ->addons += $rate->getAadons();
       $this ->numOfRatings += 1;
    }

    public function updateRate($oldRate, $newRate){
        $this ->dust += ($newRate->getDust()-$oldRate->getDust());
        $this ->general += ($newRate->getGeneral()-$oldRate->getDust());
        $this ->green += ($newRate->getGreen()-$oldRate->getDust());
        $this ->smoke += ($newRate->getSmoke()-$oldRate->getDust());
        $this ->intensity += ($newRate->getIntensity()-$oldRate->getDust());
        $this ->strength += ($newRate->getStrength()-$oldRate->getDust());
        $this ->addons += ($newRate->getAadons()-$oldRate->getDust());
    }

    public function deleteRate($rate){
        $this ->dust -= $rate->getDust();
        $this ->general -= $rate->getGeneral();
        $this ->green -= $rate->getGreen();
        $this ->smoke -= $rate->getSmoke();
        $this ->intensity -= $rate->getIntensity();
        $this ->strength -= $rate->getStrength();
        $this ->addons -= $rate->getAadons();
        $this ->numOfRatings -= 1;
    }

}