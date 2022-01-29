<?php

class Comment{

    private $id;
    private $idUser;
    private $idYerba;
    private $content;

    /**
     * @param $idUser
     * @param $idYerba
     * @param $content
     */
    public function __construct($idUser, $idYerba, $content)
    {
        $this->idUser = $idUser;
        $this->idYerba = $idYerba;
        $this->content = $content;
    }

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
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

}