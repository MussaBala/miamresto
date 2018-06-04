<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 29/03/2018
 * Time: 00:57
 */
class user
{
    public $dbh;
    private $idU;
    private $login;
    private $pwd;

    /**
     * @return mixed
     */
    public function getIdU()
    {
        return $this->idU;
    }

    /**
     * @param mixed $idU
     */
    public function setIdU($idU)
    {
        $this->idU = $idU;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param mixed $pwd
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
    }


    public function __construct()
    {
        $this->dbh = database::sharedInstance();
    }

    public function createUser(){
        return $this->dbh->insert(
            "INSERT INTO `user`
				SET `login` = '$this->login', 
				    `password` = '$this->pwd'				
			"
        );
    }

    public function readUser(){
        return $this->dbh->query( "SELECT * FROM `user` ",2 );
    }

    public function updateUser(){

    }

    public function deleteUser(){

    }

}