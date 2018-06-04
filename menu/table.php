<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26/05/2018
 * Time: 20:06
 */
require_once( "../__class/autoload.class.php" );

$object = new object();



foreach ($object->getAllTable() as $key => $value): ?>

    <div class="panel panel-default col-sm-5  col-md-6  col-lg-5 col-lg-offset-1 ChooseTable">
        <div class="panel-heading" style="width: 100%">
            <?=$value['libelleTab']?>
        </div>
        <div class="panel-body" id="tableState<?=$value['id']?>">

        </div>
        <button type="button" class="btn btn-primary addTable" id="<?=$value['id']?>">Selectionner</button>
        <button type="button" class="btn btn-primary delTable" id="<?=$value['id']?>" style="display: none">Deselectionner</button>

    </div>

<?php endforeach; ?>