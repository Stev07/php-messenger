<?php
        session_start();
        require('models/db_connect.php');
        require('models/user.php');

        //SIGNIN
        if(isset($_POST['signin'])){
            $firstname = htmlspecialchars($_POST['firstname']);//Récupération données POST
            $lastname = htmlspecialchars($_POST['lastname']);
            $email = htmlspecialchars($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);//Hash du pass avec BCRYPT
            $user = new User($firstname, $lastname, $email, $password);//Création nouvel utilisateur
            $user->addUserToDb($conn);//Envoi user -> DB
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

    <title>Inscription</title>
</head>
<body>
    <main class="clearfix container-fluid">
        <section class="col-12 col-md-6 offset-md-3">
            <img src="../public/images/phessenger.svg" class="img-fluid col-10 offset-1 col-md-6 offset-md-3"/>
            <form action="./traitements/handlerSignin.php" method="post" class="form-log">
                <h3 class="form-title text-center"> Inscription </h3>
                <div class="form-group">
                    <input type="text" class="form-control" name="firstname" placeholder="Prénom">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lastname" placeholder="Nom">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Mot de passe">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="confirm-password" placeholder="Confirmez votre mot de passe">
                </div>
                <div class="form-group">
                    <button type="submit" name="back" class="btn btn-primary col-12 col-sm-5">Retour</button>
                    <button type="submit" name="signin" class="sign-in btn btn-primary col-12 col-sm-5 float-right">S'inscrire</button>
                </div>
            </form>
        </section>

    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>