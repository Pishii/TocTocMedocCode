<?php
    require("../php/db_connection.php");
    require_once("../php/config_global.php");
    require("../php/print_symptomes/php");

    $pageName = "Recherche de remédes";
    $desc = "Veuillez décrire les symptomes que vous avez.";
    $displayQuery = new DisplayRemedesToSelect($stmtSelectSymptomes);
?>
<!DOCTYPE html>
<html>
        <?php
            displayHead($cssPath, $charset, $appname, $pageName);
        ?>
    <body>
        <h1><?echo $appname?></h1>
        <h2><?echo $pageName?></h2>
        <p><?echo $desc?></p>
        <?$displayQuery->display();?>
    </body>
</html>