<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 13/07/2017
 * Time: 19:09
 */
require_once( "autoload.class.php" );


class object
{
    private $dbh;
    private $return;

    /**
     * @return mixed
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     * @param $data
     * @internal param mixed $return
     */
    public function setReturn($data)
    {
        $return = ( $data !== false ) ? ['status' => true, 'result' => $data] : ['status' => false, 'result' => false];

        $this->return = $return;
    }

    public function __construct()
    {
        $this->dbh = database::sharedInstance();
    }



    public function getAllCategory(){
       $cat = new category();
      return $cat->readCategory();
    }


    public function getAllTable(){
        $tab = new tableResto();
        return $tab->readTableResto();
    }


    public function getPlatbyCatId($idCat){
        return $this->dbh->query("SELECT * 
                                  FROM `plat` 
                                  WHERE idCat = '$idCat'
                            ",2);
    }


    public function getInfosCatById($idCat){
        return $this->dbh->query("SELECT * 
                                  FROM `category` 
                                  WHERE id = '$idCat'
                            ",3);
    }


    public function getInfosPlatById($idPlat){
        return $this->dbh->query("SELECT * 
                                  FROM `plat` 
                                  WHERE id = '$idPlat'
                            ",3);
    }


    /**
     * @param array $array
     * @return mixed
     */
    public function createCommande($array = []){

        $com = new commande();
        $lc = new ligneCommande();
        $prixT = 0;
        $com->setIdUs(1);
        $com->setIdTab($array['idTab']);
        $com->setDateCom( date("Y-m-d H:i:s") );
        $com->setActive(1);

        foreach ($array['plat'] as $key => $value){
            foreach ($value as $val){
                $prixT += (int) $val;
            }
        }
        $com->setPrixT($prixT);
        $idCom = $com->createCom();

        foreach ($array['plat'] as $key => $value){
            $lc->setIdPlat($key);
            $lc->setIdCom($idCom);
            $nbr = count($value);
            $lc->setQte($nbr);
            $lc->createLiCom();
        }


        $this->setReturn($idCom);

        return $this->getReturn();
    }


    public function getAllCommande(){
        return $this->dbh->query("SELECT *
                                    FROM commande, ligne_commande, tableresto, plat
                                    WHERE commande.id = ligne_commande.idCom
                                    AND commande.idTab = tableresto.id
                                    AND ligne_commande.idPlat = plat.id
                                    AND commande.active = 1
                                ",2);

    }

}