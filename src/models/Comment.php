<?php

class Comment{

    private $id;
    private $idUser;
    private $idYerba;
    private $content;

    public function __construct($idUser, $idYerba, $content)
    {
        $this->idUser = $idUser;
        $this->idYerba = $idYerba;
        $this->content = $content;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    public function getIdYerba()
    {
        return $this->idYerba;
    }

    public function setIdYerba($idYerba)
    {
        $this->idYerba = $idYerba;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

}