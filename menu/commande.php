<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25/04/2018
 * Time: 10:38
 */

require_once( "../__class/autoload.class.php" );
$object = new object();

$array = [];
$array = $_POST['cmdArray'];
$nbr = 0;
$total = 0;
$output = '<table class="table table-bordered">
                <tbody id="cmdTable">';
foreach ($array as $key => $value):
    $value = (int)$value;
    $nbr += count(array_search($value, $array));
    $plat = $object->getInfosPlatById($value);

    $prix = (int) $plat['prix'];
    $total+= $prix;
    $id = (int)$plat['id'];
$output.='<tr class="platLine" id="platLine'.$id.'">
            <input type="hidden" id="'.$id.'" value="'.$prix.'" data-ligneCom="'.$nbr.'" data-totCom="'.$total.'">
            <td>'.$nbr.'</td>
            <td>'.$plat['libelleP'].'</td>
            <td>'.$prix.'</td>
            <td>
               <button id="'.$id.'" type="button" class="btn btn-default btn-lg deleteCmd" aria-label="Left Align">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                   </button>
            </td>
          </tr>
';
endforeach;

$output .='
            <tr>
                <h3>Total: <span id="TotalPrice"><b>'.$total.'</b></span></h3>
            </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-success btn-lg" id="validateCmd">Valider Commande</button>';


echo $output;

?>
<script>

</script>
