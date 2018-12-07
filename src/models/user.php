<?php
    class User {
        // Propriétés
        public $id;
        public $email;
        public $password;
        public $firstname;
        public $lastname;
        public $avatar;

        // Constructeur
        public function __construct($firstname,$lastname,$email,$password,$avatar = "", $id = null){
            $this->id = $id;
            $this->email = $email;
            $this->password = $password;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->avatar = $avatar;
        }
        // Méthode public insert
        public function addUserToDb($conn){
            $pdoStat = $conn->prepare('INSERT INTO Users VALUES(NULL, :firstname, :lastname, :email, :password, :avatar)');
            
            // Execution de la requête
            $insertIsOk = $pdoStat->execute(array(
                ':firstname' => $this->firstname,
                ':lastname' => $this->lastname,
                ':email' => $this->email,
                ':password' => $this->password,
                ':avatar' => $this->avatar
                ));

                header('Location: /index.php');
        }

        public static function getUserByEmail($conn,$email){
            $sql = "SELECT * FROM `Users` WHERE email = '$email'";//Récup données user
            $pdostat = $conn->prepare($sql);//Préparat° requête
            $pdostat->execute();//Execute la requête préparée
            $result = $pdostat->fetch();//Associat° du résultat
            $user = new User($result['firstname'],$result['lastname'],$result['email'],$result['password'],$result['avatar'],$result['id']);//Créat° user
            return $user;
        }

        public function removeUser(){
        }

        public function login(){
        
        }

        public function logout(){
        }

        public function update(){

        }
    }
?>