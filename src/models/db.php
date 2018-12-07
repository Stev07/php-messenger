<?php
    class DB {
        public $conn;

        private $DSN = "mysql:host=mysql;dbname=messenger;charset=utf8mb4";
        private $DB_USER = "messenger";
        private $DB_PASS = "messenger";

        public function __construct(){
            try {
                $this->conn = new PDO($this->DSN, $this->DB_USER, $this->DB_PASS);
            } catch (PDOException $e){
                echo "Erreur Connexion (rien ne vas plus) => " . $e->getMessage();
            }
        }
    }
?>