<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 29/03/2018
 * Time: 00:50
 */
class tableResto
{
    public $dbh;
    private $idTb;
    private $libelleTab;

    /**
     * @return mixed
     */
    public function getIdTb()
    {
        return $this->idTb;
    }

    /**
     * @param mixed $idTb
     */
    public function setIdTb($idTb)
    {
        $this->idTb = $idTb;
    }

    /**
     * @return mixed
     */
    public function getLibelleTab()
    {
        return $this->libelleTab;
    }

    /**
     * @param mixed $libelleTab
     */
    public function setLibelleTab($libelleTab)
    {
        $this->libelleTab = $libelleTab;
    }

    
    
    public function __construct()
    {
        $this->dbh = database::sharedInstance();
    }

    public function createTableResto(){
        return $this->dbh->insert(
            "INSERT INTO `tableresto`
				SET `libelleTab` = '$this->libelleTab'"
        );
    }


    public function readTableResto(){
        return $this->dbh->query("SELECT * FROM `tableresto`",2);
    }

    public function searchTableResto(){
        $search = $this->getIdTb();

        if (is_array( $search )) {
            $search = implode( ",", $search );
        }

        if (!empty( $search )) {
            return $this->dbh->query(
                "SELECT *
                   FROM `tableresto`
                  WHERE `id` IN($search)", 2
            );
        }

        return false;
    }

    public function updateTableResto(){
        $libelle = $this->dbh->protect_entry( $this->getLibelleTab() );

        if (!empty( $this->idCat )) {
            return $this->dbh->exec(
                "UPDATE `tableresto`
					SET `libelleTab` = '$libelle'
                  WHERE `id` = $this->idTab"
            );
        }
        return false;
    }

    public function deleteTableResto(){

        if (!empty( $this->getIdTb() )) {
            return $this->dbh->exec(
                "DELETE FROM `tableresto`
                  WHERE `id` = $this->idTab"
            );
        }
        return false;
    }
}