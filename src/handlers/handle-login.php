<?php 
    /**
     * Ce fichier permet la gestion (handler) de la page de login.
     * Il redirige vers la page d'inscription (signin.php) si le bouton signin est cliqué, dans le cas
     * contraire il effectue le traitement de la connexion au Chat. 
     */

    /**
     * Lancement de la session de tel manière à ce qu'on puisse accéder au variable du tableau de Session.
     * Cela nous permettra de tester si l'utilisateur est déjà connecté ou non.
     * ATTENTION: le session_start() doit être impérativement déclaré avant tout HTML (les "echo" "print_r" etc...
     * génere du code HTML, attention à lancer la session avant).
     */
    session_start();
    unset($_SESSION["auth"]);

    /**
     * Importation des fichiers nécessaires pour le fonctionnement de CE fichier.
     * J'utilise require_once, car si le fichier à déjà été appeler, il ne le rajoutera pas. Cela permet d'éviter
     * beaucoup d'erreur dans notre cas. 
     * Je n'inclus aucune vue dans ce cas ci, les redirections feront le travail.
     */
    require_once(dirname(__DIR__) . "/models/db.php");
    require_once(dirname(__DIR__) . '/models/user.php');
    //require_once(dirname(__DIR__) . '/models/conversation.php');
    //require_once(dirname(__DIR__) . '/models/message.php');
    //require_once(dirname(__DIR__) . '/models/reaction.php');


    /**
     * Vérification dans le tableau POST si signin ou login est cliqué. Lors de l'envoie d'un formulaire, toutes les informations
     * sont placées dans un tableau global $_POST ou $_GET (en fonction de la méthode donnée au form). 
     * Le $_GET récupère les paramètres placés dans l'URL, ils sont donc visible au yeux de toutes les personnes qui verrons 
     * l'URL.
     * Le $_POST quant à lui, est envoyer implicitement grâce au header de la page cible.
     * La page cible est la page qui se trouve dans le champ action du formulaire. Si aucune page n'est ciblée, elle va juste
     * recharger la même page, en ayant remplis les tableaux globaux.
     */
    if(isset($_POST['signin'])){
        /**
         * Le header permet la redirection de la page en donnant des valeurs au header HTML. Dans ce cas ci, pour 
         * rediriger, nous lui donnons le lien relatif de la page ciblée pour l'attribut "location" du header.
         * ATTENTION: le session_start() doit être impérativement déclaré avant tout HTML (les "echo" "print_r" etc...
         * génere du code HTML, attention à lancer la session avant).
        */
        header('location: /signin.php');
    }

    if(isset($_POST['login'])){
        $email = $_POST['email']; // Récupération de l'email placé dans le formulaire et envoyé en POST
        $password = $_POST['password']; // Récupération du mot de passe placé dans le formulaire et envoyé en POST

        $db = new DB(); // Création de l'objet DB (instance de la classe DB que nous avons créée)
        $user = User::getUserByEmail($db->conn, $email); // Récupération de l'utilisateur par son email

        /**
         * Vérification que le mot de passe entré est correct.
         * Vu que j'utilise password_hash pour stocker mon mdp dans la base de données, 
         * il faut utiliser une méthode appropriée pour pouvoir vérifier la fiabilité du mdp.
         * password_verify fait ce qu'il nous faut, en lui placant le password entré par l'utilisateur
         * en premier paramètre (sans hashage) et en second paramètre, le password hashé.
         */
        if(password_verify($password, $user->password)){
            header('location: /chat.php');
            $_SESSION["auth"] = true;
            $_SESSION["user_email"] = $user->email;
            exit(); // Pour ne pas que le reste du code s'éffectue, j'exit le traitement.
        }

        header('location: /');
        $_SESSION["auth"] = false;
    }
?>