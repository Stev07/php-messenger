    <?php

    class User {
        // Ici les propriétés
        public $id;
        public $email;
        public $password;
        public $firstname;
        public $lastname;

        // Ici le constructeur
        public function __construct($firstname,$lastname,$email,$password){
            $this->email = $email;
            $this->password = $password;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
        }
        // Ici la méthode public insert sans paramètre
        public function addUserToDb($conn){
            $pdoStat = $conn->prepare('INSERT INTO Users VALUES(NULL, :firstname, :lastname, :email, :password)');
            

            // Execution de la requête    
            $insertIsOk = $pdoStat->execute(array(
                ':firstname' => $this->firstname,
                ':lastname' => $this->lastname,
                ':email' => $this->email,
                ':password' => $this->password
                ));

            // header('Location: ../message.php');
        }

        public function login(){
        
        }

        public function deco(){

        }

        public function update(){

        }
    }
?>