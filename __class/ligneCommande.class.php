<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/05/2018
 * Time: 16:26
 */
class ligneCommande{


    public $dbh;
    private $idCom;
    private $idPlat;
    private $qte;

    /**
     * @return mixed
     */
    public function getIdCom()
    {
        return $this->idCom;
    }

    /**
     * @param mixed $idCom
     */
    public function setIdCom($idCom)
    {
        $this->idCom = $idCom;
    }

    /**
     * @return mixed
     */
    public function getIdPlat()
    {
        return $this->idPlat;
    }

    /**
     * @param mixed $idPlat
     */
    public function setIdPlat($idPlat)
    {
        $this->idPlat = $idPlat;
    }

    /**
     * @return mixed
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * @param mixed $qte
     */
    public function setQte($qte)
    {
        $this->qte = $qte;
    }




    /**
     * ligneCommande constructor.
     */
    public function __construct(){
        $this->dbh = database::sharedInstance();
    }


    public function createLiCom(){
        return $this->dbh->insert(
            "INSERT INTO `ligne_commande`
				SET `idCom` = '$this->idCom', 
				    `idPlat` = '$this->idPlat',
				    `qte` = '$this->qte'
			"
        );
    }


    public function readLiCom(){
        return $this->dbh->query( "SELECT * FROM `ligne_commande` ",2 );
    }


//    public function updateLiCom(){
//        return $this->dbh->insert(
//            "UPDATE `ligne_commande`
//				SET `idCom` = '$this->idCom',
//				    `idPlat` = '$this->idPlat',
//				    `qte` = '$this->qte',
//				WHERE  id = '$this->id'
//
//			"
//        );
//
//    }
}