<?php
    session_start();
    
    require_once(dirname(__DIR__) . "/models/db.php");
    require_once(dirname(__DIR__) . '/models/user.php');

    if(isset($_POST['signin'])){
        // TODO: Récupérer les valeurs, et les traiter
        $firstname = htmlspecialchars($_POST['firstname']);//Récupération données POST
        $lastname = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, ["cost" => 12]);//Hash du pass avec BCRYPT
        $confirm_pass = $_POST['confirm-password'];
        
        if(password_verify($confirm_pass, $password)){
            $user = new User($firstname, $lastname, $email, $password);//Création nouvel utilisateur
            $db = new DB();
            $user->insert($db->conn);
            header('Refresh:2; url=/');
            echo "<h3 class='text-center'>L'utilisateur a bien été ajouté!</h3>";
        } else {
            $_SESSION["failed"] = true;
            header('location: /signin.php');
        }

    }

    if(isset($_POST['back'])){
        header('location: /');
    }
?>