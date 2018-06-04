<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 29/03/2018
 * Time: 00:41
 */
class category
{
    public $dbh;
    private $idCat;
    private $libelleCat;

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

    /**
     * @return mixed
     */
    public function getLibelleCat()
    {
        return $this->libelleCat;
    }

    /**
     * @param mixed $libelleCat
     */
    public function setLibelleCat($libelleCat)
    {
        $this->libelleCat = $libelleCat;
    }

    public function __construct()
    {
        $this->dbh = database::sharedInstance();
    }

    public function createCategory(){
        return $this->dbh->insert(
            "INSERT INTO `category`
				SET `libelleCat` = '$this->libelleCat'"
        );
    }

    public function readCategory(){
        return $this->dbh->query( "SELECT * FROM `category` ",2 );

    }

    public function searchCategory(){
        $search = $this->getIdCat();

        if (is_array( $search )) {
            $search = implode( ",", $search );
        }

        if (!empty( $search )) {
            return $this->dbh->query(
                "SELECT *
                   FROM `category`
                  WHERE `id` IN($search)", 2
            );
        }

        return false;
    }

    public function updateCategory(){
        $libelle = $this->dbh->protect_entry( $this->getLibelleCat() );

        if (!empty( $this->idCat )) {
            return $this->dbh->exec(
                "UPDATE `category`
					SET `libelleCat` = '$libelle'
                  WHERE `id` = $this->idCat"
            );
        }
        return false;
    }

    public function deleteCategory(){

        if (!empty( $this->getIdCat() )) {
            return $this->dbh->exec(
                "DELETE FROM `category`
                  WHERE `id` = $this->idCat"
            );
        }
        return false;
    }
}