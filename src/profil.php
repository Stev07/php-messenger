<?php
    session_start();
    try {
        $conn = new PDO("mysql:host=mysql;dbname=messenger", 'messenger', 'messenger');
        // echo "Connected successfully";
    } catch(PDOException $e){
        // echo "Connection failed: " . $e->getMessage();
    }  


	if(isset($_POST['save'])) {
		$errMsg = '';
		// RECUP DONNEES FORMULAIRES
		$firstname = $_POST['firstname']; //SI CHGMT
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $newPasswordVarify = $_POST['newPasswordVarify'];
        
		if($newPassword != $newPasswordVarify)
            $errMsg = 'Password not matched.';
            
        
        if (((empty($newPassword))==true)&&((empty($newPasswordVarify))==true)){ //Vérifie si le mdp doit être update
            $newPassword = $_POST['currentPassword'];
            $newPasswordVarify = $_POST['currentPassword'];
        }
        
		if(($errMsg == '')&&($currentPassword == $_SESSION['password'])) {
			try {
		      $sql = "UPDATE Users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password  WHERE email = :email";
		      $stmt = $conn->prepare($sql);                       
		      $stmt->execute(array(
		        ':firstname' => $firstname,
		        ':lastname' => $lastname,
                ':email' => $email,
                ':password' => $newPassword));

				header('Location: /message.php');
				exit;
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
        }
        //MAJ AVATAR
        if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])){
            $tailleMax = 2097152; //  Limite de 2Mo
            $extensionsValid = array('jpg', 'jpeg', 'png', 'gif');

            if($_FILES['avatar']['size'] <= $tailleMax){
                $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1)); //Ignore le premier caractère(.), récupère l'extension en minuscule
                
                if(in_array($extensionUpload,$extensionsValid)){ //Vérifie la validité de l'extension
                    $target = "avatars/".$_SESSION['firstname'].$_SESSION['lastname'].".".$extensionUpload;//Définition target + nom fichier
                    $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $target);//

                    if($result){//Stock l'avatar dans le dossier et l'insère dans la DB
                        $avatarUpdate = $conn->prepare("UPDATE Users SET avatar = :avatar WHERE email = :email");
                        $avatarUpdate->execute(array(
                            'avatar' => $_SESSION['firstname'].$_SESSION['lastname']. '.'.$extensionUpload,
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

    <title>Profil</title>
</head>
<body>
    <main class="container-fluid">
        <div class="row">
            <h1 class="col-12 col-md-6 offset-md-3 centered">Your Profile</h1>
            <?php echo $extensionUpload ?>
        </div>
        <div class="row">
            <form method="post" enctype="multipart/form-data" class="col-12 col-md-6 offset-md-3">
                <div class="form-group">
                    <input type="text" class="form-control" name="firstname" value="<?php echo $_SESSION['firstname']; ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lastname" value="<?php echo $_SESSION['lastname']; ?>">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['email']; ?>">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="currentPassword" placeholder="Current password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="newPassword" placeholder="New Password (optional)">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="newPasswordVarify" placeholder="Repeat new password (optional)">
                </div><br>
                <div class="form-group">
                    <div>
                        <label>Votre avatar</label><br>
                        <input type="file" name="avatar" />
                    </div>
                    <div>
                        <img src='avatars/<?php echo $_SESSION['firstname'].$_SESSION['lastname']. '.'.$extensionUpload ?>' width="150"/>
                    </div>
                </div><br>
                <div class="form-group">
                    <button type="submit" name="back" class="btn btn-primary col-12 col-sm-5">Back</button>
                    <button type="submit" name="save" class="sign-in btn btn-primary col-12 col-sm-5 float-right">Save changes</button>
                </div>
            </form>
        </div>
    </main> 

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>