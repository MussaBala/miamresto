<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30/04/2018
 * Time: 23:26
 */

require_once( "../__class/autoload.class.php" );


$object = new object();


/**
 * @param array $_array
 * @return mixed
 */
function validateCommande($_array = []){


    foreach ($_array as $key => $value){
        if ($key == 'lastCmdArray'){
            foreach ($value as $k => $val){
                $exp_key = explode('-', $k);
                $_SESSION['new-cmd']['plat'][$exp_key[1]][] = $val;
            }
        }

        $_SESSION['new-cmd'][$key] = $value;
    }

    return $_SESSION['new-cmd'];
//return $key;
}

$tab =  validateCommande($_POST);
$resultat = $object->createCommande($tab);
echo json_encode( $resultat );
