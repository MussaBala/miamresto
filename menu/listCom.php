<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26/05/2018
 * Time: 21:34
 */
require_once( "../__class/autoload.class.php" );

$object = new object();
?>
<table class="table table-striped" style="margin-top: 25px">
    <tr>
        <th style="text-align: center">
            Table
        </th>
        <th style="text-align: center">
            Commande N°
        </th>
        <th style="text-align: center">
           Designation
        </th>
        <th style="text-align: center">
            Qté
        </th>
    </tr>
    <tbody>
    <?php foreach ($object->getAllCommande() as $key => $value): ?>
        <tr>
            <td style="text-align: center"><?=$value["libelleTab"] ?></td>
            <td style="text-align: center"><?=$value['idCom'] ?></td>
            <td style="text-align: center"><?=$value['libelleP'] ?></td>
            <td style="text-align: center"><?=$value['Qte'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

