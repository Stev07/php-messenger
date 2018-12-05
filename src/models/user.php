    <?php

    class User {
        // Ici les propriétés
        public $id;
        public $email;
        public $password;
        public $firstname;
        public $lastname;
        public $avatar;

        // Ici le constructeur
        public function __construct($firstname,$lastname,$email,$password, $id = null){
            $this->id = $id;
            $this->email = $email;
            $this->password = $password;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
        }
        // Ici la méthode public insert
        public function addUserToDb($conn){
            $pdoStat = $conn->prepare('INSERT INTO Users VALUES(NULL, :firstname, :lastname, :email, :password)');
            
            // Execution de la requête    
            $insertIsOk = $pdoStat->execute(array(
                ':firstname' => $this->firstname,
                ':lastname' => $this->lastname,
                ':email' => $this->email,
                ':password' => $this->password
                ));
        }

        public static function getUserByEmail($conn,$email){
            $sql = "SELECT * FROM `Users` WHERE email = '$email'";//Récup données user
            $pdostat = $conn->prepare($sql);//Préparat° requête
            $pdostat->execute();
            $result = $pdostat->fetch();//Associat° du résultat
            $user = new User($result['firstname'],$result['lastname'],$result['email'],$result['password'],$result['id']);//Créat° user
            return $user;
        }

        public function login(){
        
        }

        public function logout(){
        }

        public function update(){

        }
    }
?>