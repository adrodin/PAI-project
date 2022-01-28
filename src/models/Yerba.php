<?php

class Yerba
{
    private $id;
    private $origin;
    private $type;
    private $name;
    private $description;
    private $image;


    public function getOrigin()
    {
        return $this->origin;
    }

    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }


    public function getType()
    {
        return $this->type;
    }


    public function setType($type)
    {
        $this->type = $type;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function getImage()
    {
        return $this->image;
    }


    public function setImage($image)
    {
        $this->image = $image;
    }

    public function __construct($origin, $type, $name, $description, $image)
    {
        $this->origin = $origin;
        $this->type = $type;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }


}