<?php 
    class User {
        public $id;
        public $firstname;
        public $lastname;
        public $email;
        public $password;
        public $avatar;

        public function __construct($firstname, $lastname, $email, $password, $avatar = "", $id=null){
            $this->id = $id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->password = $password;
            $this->avatar = $avatar;
        }

        public function insert($conn){
            $sql = "INSERT INTO Users VALUES(:id, :firstname, :lastname, :email, :password, :avatar);";
            $options = array(
                "id" => $this->id,
                "firstname" => $this->firstname,
                "lastname" => $this->lastname,
                "email" => $this->email,
                "password" => $this->password,
                "avatar" => $this->avatar
            );
            $stmt = $this->conn->prepare($sql);
            $success = $stmt->execute($options);

            return $success;
        }

        public function update($conn){
            $sql = "UPDATE Users SET firstname=':firstname' AND lastname=':lastname' AND email=':email' 
                    AND password=':password' AND avatar=':avatar' WHERE id=:id;";
            $options = array(
                "firstname" => $this->firstname,
                "lastname" => $this->lastname,
                "email" => $this->email,
                "password" => $this->password,
                "avatar" => $this->avatar,
                "id" => $this->id
            );

            $stmt = $conn->prepare($sql);
            $success = $stmt->execute($options);

            return $success;
        }

        /**
         * GET ALL THE USERS IN THE DB
         * 
         * Fonction statique, ne nécessite pas d'instance de classe (d'objet) pour être appelée.
         * Exemple d'utilisation: User::getUsers($connexion);
         */
        public static function getUsers($conn){
            $sql = 'SELECT * FROM Users;';

            $stmt = $conn->prepare($sql);
            $success = $stmt->execute();
            $result = $stmt->fetchAll();
            
            if(!$result || !$success){
                return false;
            }

            $users = array();
            foreach($result as $user) {
                $users[] = new User($user['firstname'], $user['lastname'], $user['email'], $user['password'], "", $user['user_id']);;
            }

            return $users;
        }

        /**
         * GET ONE USER BY THE EMAIL
         * 
         * Fonction statique, ne nécessite pas d'instance de classe (d'objet) pour être appelée.
         * Exemple d'utilisation: User::getUserByEmail($connexion, "valentin@becode.com");
         */
        public static function getUserByEmail($conn, $email){
            $sql = "SELECT * FROM Users WHERE email='$email' LIMIT 1;";
            $stmt = $conn->prepare($sql);
            $success = $stmt->execute();
            if(!$success) return false;

            $result = $stmt->fetch();

            return new User($result["firstname"], $result["lastname"], $result["email"], $result["password"], "", $result["id"]);
        }

        /**
         * GET ONE USER BY THE ID
         * 
         * Fonction statique, ne nécessite pas d'instance de classe (d'objet) pour être appelée.
         * Exemple d'utilisation: User::getUserById($connexion, 1);
         */
        public static function getUserById($conn, $id){
            $sql = "SELECT * FROM Users WHERE id=$id LIMIT 1;";
            $stmt = $conn->prepare($sql);
            $success = $stmt->execute();
            if(!$success) return false;

            $result = $stmt->fetch();

            return new User($result["firstname"], $result["lastname"], $result["email"], $result["password"], "", $result["id"]);
        }
    }
?>