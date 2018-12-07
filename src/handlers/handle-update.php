<?php
    session_start();
    require_once(dirname(__DIR__) . "/models/db.php");
    require_once(dirname(__DIR__) . '/models/user.php');
    $email = $_SESSION['user_email'];
    $db = new DB();

    $user = User::getUserByEmail($db->conn, $email);//Récupération de l'objet user

//UPDATE NOM/EMAIL
    if(isset($_POST['saveUser'])){        
        //RECUP DONNEES FORMULAIRE
        $user->firstname = $_POST['firstname'];
        $user->lastname = $_POST['lastname'];

        if($user->updateUser($db->conn)){
            header('Location: /chat.php');
            exit;
        }
    }
    
//UPDATE PASSWORD
    if(isset($_POST['savePass'])){
        $errMsg = '';
        
        //RECUP DONNEES FORMULAIRE     
        $email = $_POST['email'];
        $currentPassword = $_POST['currentPassword'];
        $newPassword = password_hash($_POST['newPassword'], PASSWORD_BCRYPT, ['cost' => 12]);
        $newPasswordVarify = $_POST['newPasswordVarify'];
        
        if(password_verify($currentPassword, $user->password) && password_verify($newPasswordVarify, $newPassword)){
            $user->password = $newPassword;
            $user->updatePassword($db->conn);
            
            header('location: /chat.php');
            exit;
        }
    }

//UPDATE AVATAR
    if(isset($_POST['saveAvatar'])){
        $errMsg = '';     
        
        if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])){
            $tailleMax = 2097152; //Limite de 2Mo
            $extensionsValid = array('jpg', 'jpeg', 'png', 'gif');//Limitation extent°

            if($_FILES['avatar']['size'] <= $tailleMax){
                $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1)); //Ignore le premier caractère(.), récupère l'extension en minuscule
                
                if(in_array($extensionUpload,$extensionsValid)){ //Vérifie la validité de l'extension
                    $target = dirname(__DIR__) . "/avatars/".$user->firstname.$user->lastname.".".$extensionUpload;//Définition target + nom fichier
                    $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $target);//

                    if($result){//Stock l'avatar dans le dossier et l'insère dans la DB
                        $user->avatar = $user->firstname.$user->lastname. '.'.$extensionUpload;
                        $user->updateAvatar($db->conn);
                    }
                }
            }
            
        }
        header('location: /chat.php');
        exit;
    }

?>