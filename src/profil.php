<?php
    session_start();
    require 'models/user.php';
    require 'models/db_connect.php';
    $email = $_SESSION['email'];
    $user = User::getUserByEmail($conn,$email);//Récupération de l'objet user

//CONNEXION DB
    try {
        $conn = new PDO("mysql:host=mysql;dbname=messenger", 'messenger', 'messenger');
        // echo "Connected successfully";
    } catch(PDOException $e){
        // echo "Connection failed: " . $e->getMessage();
    }  


//UPDATE NOM/EMAIL
    if(isset($_POST['saveUser'])){
        $errMsg = '';
        
        //RECUP DONNEES FORMULAIRE
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        

        if($errMsg == '') {
            try{
                $sql = "UPDATE Users SET firstname = :firstname, lastname = :lastname  WHERE email = :email";
                $stmt = $conn->prepare($sql);//Préparation requête SQL
                $stmt->execute(array(
                    ':firstname' => $firstname,//Envoi data -> DB
                    ':lastname' => $lastname,
                    ':email' => $email));

                header('Location: /message.php');
                exit;
            }
            catch(PDOException $e) {
                $errMsg = $e->getMessage();
            }
        }

    }
    
//UPDATE PASSWORD
    if(isset($_POST['savePass'])){
        $errMsg = '';
        
        //RECUP DONNEES FORMULAIRE     
        $email = $_POST['email'];
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $newPasswordVarify = $_POST['newPasswordVarify'];
        
        if($newPassword != $newPasswordVarify){
            $errMsg = "Password not matched";
        } else {
            try{
                
                if(password_verify($currentPassword, $user->password)){
                    $sql = "UPDATE Users SET password=:password WHERE email = '$user->email'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(array(//Execute la requête préparée
                        ':password' => password_hash($newPassword, PASSWORD_BCRYPT)));//Envoi data -> DB
                }
                    header('Location: /message.php');
                    exit;
            }
            catch(PDOException $e) {
                $errMsg = $e->getMessage();
            }
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
                    $target = "avatars/".$user->firstname.$user->lastname.".".$extensionUpload;//Définition target + nom fichier
                    $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $target);//

                    if($result){//Stock l'avatar dans le dossier et l'insère dans la DB
                        $avatarUpdate = $conn->prepare("UPDATE Users SET avatar = :avatar WHERE email = :email");
                        $avatarUpdate->execute(array(
                            'avatar' => $user->firstname.$user->lastname. '.'.$extensionUpload,//Envoi data -> DB
                            'email' => $_SESSION['email']));
                    }
                }
            }
            header('Location: /message.php');
            exit;
        }

    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/styles.css" />
    <link rel="stylesheet" href="../public/css/profil.css" />

    <title>Profil</title>
</head>
<body>
    <main class="container">
        <div class="title">
            <h1 class="profil">Your Profile</h1>
        </div>
        <div class="userBox">
        <!-- INFOS USER -->
            <form method="post" class="user">
                <div class="form-group">
                    <input type="text" class="form-control" name="firstname" value="<?php echo $user->firstname; ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lastname" value="<?php echo $user->lastname; ?>">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" value="<?php echo $user->email; ?>">
                </div>
                <div class="form-group">
                    <button type="submit" name="saveUser" class="sign-in btn btn-primary col-12 col-sm-5">Save changes</button>
                </div>
            </form>
        <!-- INFOS PASSWORD -->
        <form method="post" class="password">
                <div class="form-group">
                    <input type="password" class="form-control" name="currentPassword" placeholder="Current password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="newPassword" placeholder="New Password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="newPasswordVarify" placeholder="Repeat new password">
                </div>
                <div class="form-group">
                    <button type="submit" name="savePass" class="sign-in btn btn-primary col-12 col-sm-5">Save changes</button>
                </div>
            </form>
        <!-- INFOS AVATAR -->
        <form method="post" enctype="multipart/form-data" class="avatar">
            <div class="form-group">
                <div>
                    <input type="file" name="avatar" />
                </div>
                <div>
                    <img alt="avatar" src="avatars/<?php echo $user->avatar; ?>" width="150px"/>
                </div>
                </div><br>
                <div class="form-group">
                    <button type="submit" name="saveAvatar" class="sign-in btn btn-primary col-4">Save changes</button>
                </div>
        </form>
        </div>
        <br>
        <div class="back">
            <button type="submit" name="back" class="btn btn-primary col-6">Back</button>
        </div>
    </main> 

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>