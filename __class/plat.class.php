<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 29/03/2018
 * Time: 01:05
 */
class plat
{
    public $dbh;
    private $libelleP;
    private $ingr;
    private $price;
    private $idCat;

    /**
     * @return mixed
     */
    public function getLibelleP()
    {
        return $this->libelleP;
    }

    /**
     * @param mixed $libelleP
     */
    public function setLibelleP($libelleP)
    {
        $this->libelleP = $libelleP;
    }

    /**
     * @return mixed
     */
    public function getIngr()
    {
        return $this->ingr;
    }

    /**
     * @param mixed $ingr
     */
    public function setIngr($ingr)
    {
        $this->ingr = $ingr;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getIdCat()
    {
        return $this->idCat;
    }

    /**
     * @param mixed $idCat
     */
    public function setIdCat($idCat)
    {
        $this->idCat = $idCat;
    }


    public function __construct()
    {
        $this->dbh = database::sharedInstance();
    }

    public function createPlat(){
        return $this->dbh->insert(
            "INSERT INTO `plat`
				SET `libelleP` = '$this->libelleP', 
				    `ingredient` = '$this->ingr',
				    `prix` = '$this->price',
				    `idCat` = '$this->idCat',
			"
        );
    }

    public function readPlat(){
        return $this->dbh->query( "SELECT * FROM `plat` ",2 );
    }

    public function updatePlat(){

    }

    public function deletePlat(){

    }
}