<?php 
    session_start(); 
    if(!isset($_SESSION['id'])){ ?>
        <script>window.location.href = '/'; </script>
<?php
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

    <title>Profile</title>
</head>
<body>
    <?php 
        require('../models/db.php');
        require('../models/user.php');
       
        $user = User::getUserById($_SESSION['id']);
    ?>
    <main class="container-fluid">
        <div class="row">
            <h1 class="col-12 col-md-6 offset-md-3 centered">Your Profile</h1>
        </div>
        <div class="row">
            <form method="post" class="col-12 col-md-6 offset-md-3">
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
                    <input type="password" class="form-control" name="password" value="<?php echo $user->password; ?>">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="New password">
                </div>
                <div class="form-group">
                    <button type="submit" name="back" class="btn btn-primary col-12 col-sm-5">Back</button>
                    <button type="submit" name="save" class="sign-in btn btn-primary col-12 col-sm-5 float-right">Save changes</button>
                </div>
            </form>
        </div>

        <?php 
        // TODO: completer le script
            if(isset($_POST["back"])){ 
                ?>
                <script>window.location.href = '/index.php';</script>
            <?php
            }
        ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>