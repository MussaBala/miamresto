<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29/03/2018
 * Time: 07:38
 */
//session_start();
require_once( "../__class/autoload.class.php" );
$object = new object();

$idCat = $_POST['idCat'];
$idTab = $_POST['idTab'];

$_SESSION['new-cmd']['idTab'] = $idTab;


$res = $object->getInfosCatById($idCat);

$output = '
<div class="col-sm-12 col-md-12 col-lg-12">
   <div class="panel panel-default">
        <div class="panel-heading">
            <h3 align="center">'.$res['libelleCat'].'</h3>
        </div>
        <div class="panel-body">';
             foreach ($object->getPlatbyCatId($idCat) as $key => $value):
                $output.= '
                    <div class="panel panel-default col-sm-5  col-md-6  col-lg-5 col-lg-offset-1 menuPart">
                        <div class="panel-body" style="width: 100%">
                            <p class="plat-infos" data-nomP='.$value['libelleP'].'>'.$value['libelleP'].'</p>
                            <p id="ingrPart" data-ing="'.$value['ingredient'].' style="color: #c7c7c7;">('.$value['ingredient'].')</p>
                        </div>
                        <div class="panel-footer plat-price" data-price="'.$value['prix'].'"  style="width: 100%">'.$value['prix'].'Franc CFA</div>
                        <button type="button" class="btn btn-success addCmd" id="'.$value['id'].'">Ajouter</button>
                    </div>';
           endforeach;
$output.="</div></div></div>";

echo $output;

?>
