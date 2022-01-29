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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getGeneral()
    {
        return $this->general;
    }

    /**
     * @param mixed $general
     */
    public function setGeneral($general)
    {
        $this->general = $general;
    }

    /**
     * @return mixed
     */
    public function getDust()
    {
        return $this->dust;
    }

    /**
     * @param mixed $dust
     */
    public function setDust($dust)
    {
        $this->dust = $dust;
    }

    /**
     * @return mixed
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * @param mixed $green
     */
    public function setGreen($green)
    {
        $this->green = $green;
    }

    /**
     * @return mixed
     */
    public function getSmoke()
    {
        return $this->smoke;
    }

    /**
     * @param mixed $smoke
     */
    public function setSmoke($smoke)
    {
        $this->smoke = $smoke;
    }

    /**
     * @return mixed
     */
    public function getIntensity()
    {
        return $this->intensity;
    }

    /**
     * @param mixed $intensity
     */
    public function setIntensity($intensity)
    {
        $this->intensity = $intensity;
    }

    /**
     * @return mixed
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param mixed $strength
     */
    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    /**
     * @return mixed
     */
    public function getAddons()
    {
        return $this->addons;
    }

    /**
     * @param mixed $addons
     */
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