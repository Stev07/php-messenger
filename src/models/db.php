<?php
// Ne preter pas attention à cette classe.
    class MyDB {
        private static $_instance = null;

        private $dsn = 'mysql:dbname=messenger;host=mysql';
        private $user = 'messenger';
        private $pwd = 'messenger';

        public static function Instance(){
            if(is_null(self::$_instance)){
                try {
                    self::$_instance = new PDO('mysql:dbname=messenger;host=mysql', 'messenger', 'messenger');
                }catch(PDOException $e){
                    echo 'Connection Failed : ' . $e->getMessage();
                }
            }
            return self::$_instance;
        }
    }
?>