<?php

class Values
{

    protected $id;
    protected $general;
    protected $dust;
    protected $green;
    protected $smoke;
    protected $intensity;
    protected $strength;
    protected $addons;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getGeneral()
    {
        return $this->general;
    }

    public function setGeneral($general)
    {
        $this->general = $general;
    }

    public function getDust()
    {
        return $this->dust;
    }

    public function setDust($dust)
    {
        $this->dust = $dust;
    }

    public function getGreen()
    {
        return $this->green;
    }

    public function setGreen($green)
    {
        $this->green = $green;
    }

    public function getSmoke()
    {
        return $this->smoke;
    }

    public function setSmoke($smoke)
    {
        $this->smoke = $smoke;
    }

    public function getIntensity()
    {
        return $this->intensity;
    }

    public function setIntensity($intensity)
    {
        $this->intensity = $intensity;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    public function getAddons()
    {
        return $this->addons;
    }

    public function setAddons($addons)
    {
        $this->addons = $addons;
    }

    public function __construct($general, $dust, $green, $smoke, $intensity, $strength, $addons)
    {
        $this->general = $general;
        $this->dust = $dust;
        $this->green = $green;
        $this->smoke = $smoke;
        $this->intensity = $intensity;
        $this->strength = $strength;
        $this->addons = $addons;
    }
}