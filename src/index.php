<?php
    session_start();
    require ('/models/user.php');   

    try {
        $conn = new PDO("mysql:host=mysql;dbname=messenger", 'messenger', 'messenger');
        // echo "Connected successfully";
    } catch(PDOException $e){
        // echo "Connection failed: " . $e->getMessage();
    }

    // if(empty($_SESSION['email']))
	// 	// header('Location: login.php');
    
    if(isset($_POST['login'])) {
		$errMsg = '';
		$email = $_POST['email'];
        $password = $_POST['password'];
        
		if($email == '')
			$errMsg = 'Enter email';
		if($password == '')
			$errMsg = 'Enter password';
		if($errMsg == '') {
			try {
                $stmt = $conn->prepare('SELECT id, firstname, lastname, email, password FROM `Users` WHERE email = :email');
                
				$result = $stmt->execute(array(
					':email' => $email
					));
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                
				if($data == false){
					$errMsg = "User $email not found.";
				}else {
					if($password == $data['password']) {
						$_SESSION['email'] = $data['email'];
                        $_SESSION['password'] = $data['password'];
                        $email = $_SESSION['email'];
                        $name = $conn->query("SELECT firstname FROM Users WHERE email = '$email' ");
                        $_SESSION['firstname']=$name->fetchColumn();
                        $namelast = $conn->query("SELECT lastname FROM Users WHERE email = '$email' ");
                        $_SESSION['lastname']=$namelast->fetchColumn();
						header('Location: message.php');
						exit;
					}else
						$errMsg = 'Password not match.';
				}
			}catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
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

    <title>Index</title>
</head>
<body>
    <main class="clearfix container-fluid">
        <section class="col-12 col-md-6 offset-md-3">
            <img src="public/images/phessenger.svg" class="img-fluid col-10 offset-1 col-md-8 offset-md-2"/>
            <form method="post">
                <div class="form-group">
                    <br>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <button type="submit" name="login" class="btn btn-primary col-12 col-sm-5">Login</button>
                    <button name="signin" class="sign-in btn btn-primary col-12 col-sm-5 float-right">Sign in</button>
                </div>

            </form>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>