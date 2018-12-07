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
            $stmt = $conn->prepare($sql);
            $success = $stmt->execute($options);

            return $success;
        }

        public function updateUser($conn){
            $sql = "UPDATE Users SET firstname = :firstname, lastname = :lastname  WHERE email = :email";
            $options = array(
                'firstname' => $this->firstname,//Envoi data -> DB
                'lastname' => $this->lastname,
                'email' => $this->email
            );

            $stmt = $conn->prepare($sql);//Préparation requête SQL
            $success = $stmt->execute($options);

            return $success;
        }

        public function updatePassword($conn){
            $sql = "UPDATE Users SET password = :password WHERE email = :email";
            $options = array(
                'password' => $this->password,
                'email' => $this->email
            );

            $stmt = $conn->prepare($sql);//Préparation requête SQL
            $success = $stmt->execute($options);

            return $success;
        }

        public function updateAvatar($conn){
            $sql = "UPDATE Users SET avatar = :avatar WHERE email = :email";
            $options = array(
                'avatar' => $this->avatar,
                "email" => $this->email
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
                $users[] = new User($user['firstname'], $user['lastname'], $user['email'], $user['password'], $user['avatar'], $user['user_id']);;
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

            return new User($result["firstname"], $result["lastname"], $result["email"], $result["password"], $result['avatar'], $result["id"]);
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

            return new User($result["firstname"], $result["lastname"], $result["email"], $result["password"], $result['avatar'],  $result["id"]);
        }

        public static function getParticipatingUsers($conn, $conversation_id){
            $sql = "SELECT DISTINCT Users.* FROM Users JOIN Messages ON Messages.author_id=Users.id WHERE Messages.conversation_id=:conv_id";
            $options = array(
                "conv_id" => $conversation_id
            );

            $stmt = $conn->prepare($sql);
            $success = $stmt->execute($options);
            $result = $stmt->fetchAll();
            
            if(!$result || !$success) return false;

            $users = array();
            foreach($result as $user) {
                $users[] = new User($user['firstname'], $user['lastname'], $user['email'], $user['password'], "", $user['user_id']);;
            }

            return $users;
        }
    }
?>