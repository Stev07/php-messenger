<?php
    session_start();
    
    require_once(dirname(__DIR__) . "/models/db.php");
    require_once(dirname(__DIR__) . '/models/user.php');

    if(isset($_POST['signin'])){
        // TODO: Récupérer les valeurs, et les traiter

        header('Refresh:2; url=/');
        echo "<h3>L'utilisateur a bien été ajouté!</h3>";
    }

    if(isset($_POST['back'])){
        header('location: /');
    }
?>