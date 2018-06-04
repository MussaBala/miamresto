<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13/07/2017
 * Time: 19:01
 */
//if (isset($_SESSION['new-cmd'])){
//    session_destroy();
//}
session_start();

    require_once( "./__class/autoload.class.php" );

$object = new object();

?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MiamResto</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-html5-1.5.1/datatables.min.css"/>

    <!-- Bootstrap Core CSS -->
    <link href="./template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./template/css/datatables.css"/>

    <!-- CUSTOM CSS-->
    <link rel="stylesheet" href="./template/css/style.css"/>

    <!-- MetisMenu CSS -->
    <link href="./template/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./template/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="./template/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./template/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <!-- jQuery -->
    <script src="./template/vendor/jquery/jquery.js"></script>
    <script type="text/javascript" src="./template/js/dist/jquery.validate.js"></script>
    <script src="./template/js/datatables.js"></script>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">O' MIAM</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">

        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="../index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <?php foreach ($object->getAllCategory() as $key => $value): ?>
                    <li  class="catSelect" id="<?= $value['id'] ?>">
                        <a href="#">
                            <?= $value['libelleCat'] ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <!-- start page-wrapper -->
    <div id="page-wrapper" class="col-md-6" style="border: 2px solid cadetblue">
        <div id="pageup-wrapper" style="border-bottom: 2px solid #0c0c0c;">

        </div>

        <div id="pagedown-wrapper">

        </div>

    </div>

    <div class="col-md-3" style="border: 1px solid #9f191f">
        <div class="row-fluid" align="center">
            <h2>COMMANDES</h2>
        </div>
        <div class="row-fluid">
            <table>
                <tbody id="command-wrapper">

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /#wrapper -->

<!-- Bootstrap Core JavaScript -->
<script src="./template/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="./template/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="./template/dist/js/sb-admin-2.js"></script>

<script>
    $(document).ready(function () {

        var cmdArray = [];
        var ligne = [];
        var idTab = 0;

        $('.delTable').hide();


        $("#pageup-wrapper").load("./menu/table.php", function(){
            addTable();
        });

        $("#pagedown-wrapper").load("./menu/listCom.php");

        $(".catSelect").click(function (e) {
            e.preventDefault();
            var idCat = $(this).attr("id");

            $("#pageup-wrapper").load("./menu/plat.php", {idCat: idCat, idTab: idTab}, function (response, status, xhr) {
                    if (status == "error") {
                        var msg = "Sorry but there was an error: ";
                        $("#error").html(msg + xhr.status + " " + xhr.statusText);
                    }
                    addcommande();
                }
            );
        });

        function addTable() {
            $(".addTable").click(function (t) {
                t.preventDefault();

                idTab = $(this).attr("id");

                $('#tableState' + idTab).html("<h1><b><center>Table Occupée</center></b><h1>");
                $('.addTable'+ idTab).hide();
                $('.delTable'+ idTab).show();

            });
        }

        function addcommande() {
            $(".addCmd").on('click', function (a) {

                a.preventDefault();
                var idPlat = $(this).attr("id");
                cmdArray.push(idPlat);

                sendCommande();
            })
        }


        function sendCommande() {
            $("#command-wrapper").load("./menu/commande.php", {cmdArray: cmdArray}, function (response, status, xhr) {
                    if (status == "error") {
                        var msg = "Sorry but there was an error: ";
                        $("#error").html(msg + xhr.status + " " + xhr.statusText);
                    }
                    deletePlat();
                    ligne = cmdArray;
                    validateCmd();
                }
            );
        }

        function deletePlat() {
            $(".deleteCmd").click(function (d) {
                d.preventDefault();
                var id = $(this).attr("id");
                $('#platLine' + id).remove();
                console.log(cmdArray);
                var index = cmdArray.indexOf(id);
                if (index > -1) {
                    cmdArray.splice(index, 1);
                }

                sendCommande();
            });
        }

        function validateCmd() {
            var total = 0;
            $("#validateCmd").click(function () {
                var lastCmdArray = {};
                $("#cmdTable tr input").each(function () {
                    var platId = $(this).attr("id");
                    var price = $(this).attr("value");
                    var nbre = $(this).attr("data-ligneCom");
                    var key = nbre + "-" + platId;
                    total = $(this).attr("data-totCom");

//                    setQuantite(platId);

                    lastCmdArray[key] = price;

                });

                $.ajax({
                    type: "POST",
                    url: "./menu/cmdValidate.php",
                    dataType: 'json',
                    data: {lastCmdArray: lastCmdArray, idTab: idTab},
                    success: function (data) {
                        console.log(data);
                        $("#command-wrapper").load("./menu/commandeValide.php");
                        $("#pageup-wrapper").load("./menu/table.php");
                        $("#pagedown-wrapper").load("./menu/listCom.php");

                    }
                });
            });
        }
    });
</script>

</body>

</html>
