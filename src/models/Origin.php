<?php

class Origin{
    private $id;
    private $name;
    private $flag;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getFlag()
    {
        return $this->flag;
    }

    public function setFlag($flag)
    {
        $this->flag = $flag;
    }

    public function __construct( $name, $flag)
    {
        $this->name = $name;
        $this->flag = $flag;
    }

}