<?php 
    session_start(); 
    $output = null;
    if(isset($_SESSION["auth"])){
        if($_SESSION["auth"]){
            header("location: chat.php");
        } else {
            $output = "Erreur dans l'email ou le mot de passe.";
            unset($_SESSION["auth"]);
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
    <link rel="stylesheet" href="public/css/styles.css" />

    <title>Login</title>
</head>
<body>
    <main class="clearfix container-fluid">
        <section class="col-12 col-md-6 offset-md-3">
            <img src="public/images/phessenger.svg" class="img-fluid col-10 offset-1 col-md-6 offset-md-3"/>
            <form action="./handlers/handle-login.php" method="post" class="form-log">
                <h3 class="form-title text-center"> Connexion </h3>
                <div class="form-group">
                    <br>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <button type="submit" name="login" class="btn btn-primary col-12 col-sm-5">Se connecter</button>
                    <button type="submit" name="signin" class="sign-in btn btn-primary col-12 col-sm-5 float-right">Inscription</button>
                </div>
                <?php 
                if(isset($output)){
                    echo "<h4 class='form-error text-center'>$output</h4>";
                }
                ?>
            </form>  
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> 
</body>
</html>