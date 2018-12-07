<?php
    session_start();
    require_once("models/db.php");
    require_once('models/user.php');
    $email = $_SESSION['user_email'];
    $db = new DB();

    $user = User::getUserByEmail($db->conn, $email);//Récupération de l'objet user
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/profil.css" />

    <title>Profil</title>
</head>
<body>
    <main class="container">
        <div class="title">
            <h1 class="profil">Votre profil</h1>
        </div>
        <div class="userBox">
        <!-- INFOS USER -->
            <form action="handlers/handle-update.php" method="post" class="user">
                <div class="form-group">
                    <input type="text" class="form-control" name="firstname" value="<?php echo $user->firstname; ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lastname" value="<?php echo $user->lastname; ?>">
                </div>
                <div class="form-group">
                    <button type="submit" name="saveUser" class="sign-in btn btn-primary col-12 col-sm-5">Sauvegarder</button>
                </div>
            </form>
            <!-- INFOS PASSWORD -->
            <form action="handlers/handle-update.php" method="post" class="password">
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
                    <button type="submit" name="savePass" class="sign-in btn btn-primary col-12 col-sm-5">Sauvegarder</button>
                </div>
            </form>
            <!-- INFOS AVATAR -->
            <form action="handlers/handle-update.php" method="post" enctype="multipart/form-data" class="avatar">
                <div class="form-group">
                    <div>
                        <input type="file" name="avatar" />
                    </div>
                    <div>
                        <img alt="avatar" src="avatars/<?php echo $user->avatar; ?>" width="150px"/>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" name="saveAvatar" class="sign-in btn btn-primary col-4">Sauvegarder</button>
                </div>
            </form>
        </div>
            <br>
        <div class="back">
            <a href="/" class="btn btn-primary col-6">Back</a>
        </div>
    </main> 

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>