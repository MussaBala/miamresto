<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 29/03/2018
 * Time: 01:10
 */
class commande
{
    public $dbh;
    private $id;
    private $idPlat;
    private $idTab;
    private $idUs;
    private $prixT;
    private $dateCom;
    private $active;

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
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
    public function getIdTab()
    {
        return $this->idTab;
    }

    /**
     * @param mixed $idTab
     */
    public function setIdTab($idTab)
    {
        $this->idTab = $idTab;
    }

    /**
     * @return mixed
     */
    public function getIdUs()
    {
        return $this->idUs;
    }

    /**
     * @param mixed $idUs
     */
    public function setIdUs($idUs)
    {
        $this->idUs = $idUs;
    }

    /**
     * @return mixed
     */
    public function getPrixT()
    {
        return $this->prixT;
    }

    /**
     * @param mixed $prixT
     */
    public function setPrixT($prixT)
    {
        $this->prixT = $prixT;
    }

    /**
     * @return mixed
     */
    public function getDateCom()
    {
        return $this->dateCom;
    }

    /**
     * @param mixed $dateCom
     */
    public function setDateCom($dateCom)
    {
        $this->dateCom = $dateCom;
    }



    public function __construct()
    {
        $this->dbh = database::sharedInstance();
    }

    public function createCom(){
        return $this->dbh->insert(
            "INSERT INTO `commande`
				SET `idTab` = '$this->idTab',
				    `idUs` = '$this->idUs',
				    `prixT` = '$this->prixT',
				    `dateCom` = '$this->dateCom',
				    `active` = '$this->active'
			"
        );
    }

    public function readCom(){
        return $this->dbh->query( "SELECT * FROM `commande` ",2 );
    }

    public function updateCom(){
        return $this->dbh->insert(
            "UPDATE `commande`
				SET `idTab` = '$this->idTab',
				    `idUs` = '$this->idUs',
				    `prixT` = '$this->prixT',
				    `dateCom` = '$this->dateCom',
				WHERE  id = '$this->id'
			"
        );
    }

    public function deleteCom(){

    }


}