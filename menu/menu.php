<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29/03/2018
 * Time: 01:51
 */
$object = new object();
?>
<div class="row-fluid" id="menu">
    <?php foreach ($object->getAllCategory() as $key => $value): ?>
        <a href="../index.php?page=plat&idCat=<?= $value['id'] ?>">
            <div class="col-md-5 menuPart" id="<?= $value['id'] ?>">
                <?= $value['libelleCat'] ?>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#menu-side").html()
    });
</script>
